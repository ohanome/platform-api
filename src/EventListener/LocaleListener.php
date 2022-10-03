<?php
namespace App\EventListener;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Routing\Matcher\UrlMatcher;

class LocaleListener implements EventSubscriberInterface
{

    /**
     * @var $routeCollection RouteCollection
     */
    private $routeCollection;

    /**
     * @var $urlMatcher UrlMatcher;
     */
    private $urlMatcher;


    private $oldUrl;
    private $newUrl;
    private $languages;
    private $defaultLanguage;

    public function __construct(RouterInterface $router, array $languages = [], $defaultLanguage = 'de')
    {
        $this->routeCollection = $router->getRouteCollection();
        $this->languages = $languages;
        $this->defaultLanguage = $defaultLanguage;
    }

    public function onKernelRequest(RequestEvent $event)
    {
        $request = $event->getRequest();
        $this->newUrl  = $request->getPathInfo();
        $this->oldUrl = $request->headers->get('referer');
        $locale = $this->checkLanguage();
        if($locale === null) return;

        dd($request, $this);

        $request->setLocale($locale);

        $pathLocale = "/".$locale.$this->newUrl;

        //We have to catch the ResourceNotFoundException
        try {
            //Try to match the path with the local prefix
            $this->urlMatcher->match($pathLocale);
            $event->setResponse(new RedirectResponse($pathLocale));
        } catch (\Symfony\Component\Routing\Exception\ResourceNotFoundException $e) {

        } catch (\Symfony\Component\Routing\Exception\MethodNotAllowedException $e) {

        }
    }
    private function checkLanguage(){
        foreach($this->languages as $language){
            if(preg_match_all("/\/$language\//", $this->newUrl))
                return null;
            if(preg_match_all("/\/$language\//", $this->oldUrl))
                return $language;
        }

        return $this->defaultLanguage;
    }
    public static function getSubscribedEvents()
    {
        return array(
            // must be registered before the default Locale listener
            KernelEvents::REQUEST => ['onKernelRequest'],
        );
    }
}