# Platform-API

## Error-Codes

| Category | Sub-Category | Error Code | Full code | Description                  |
|---------:|-------------:|-----------:|:---------:|------------------------------|
|        1 |            - |          - |     -     | User related                 |
|        - |            1 |          - |     -     | Account related              |
|        - |            - |         01 |   1101    | Account not activated        |
|        - |            - |         02 |   1102    | Account not verified         |
|        - |            - |         03 |   1103    | Activation code invalid      |
|        - |            - |         04 |   1104    | Activation user invalid      |
|        - |            - |         05 |   1105    | Activation code already used |
|        - |            2 |          - |     -     | User related (general)       |
|        - |            - |         01 |   1201    | Username already exists      |
|        - |            - |         02 |   1202    | Username blocked             |
|        - |            - |         03 |   1203    | User not found               |
|        - |            - |         04 |   1204    | Username missing             |
|        - |            - |         05 |   1205    | Username invalid             |
|        - |            3 |          - |     -     | Email related                |
|        - |            - |         01 |   1301    | Email already exists         |
|        - |            - |         02 |   1302    | Email invalid                |
|        - |            - |         03 |   1303    | Email missing                |
|        - |            4 |          - |     -     | Email missing                |
|        - |            - |         01 |   1401    | Password missing             |
|        2 |            - |          - |     -     | Connection related           |
|        - |            1 |          - |     -     | Method related               |
|        - |            - |         01 |   2101    | Method must be GET           |
|        - |            - |         02 |   2102    | Method must be POST          |
|        - |            - |         03 |   2103    | Method must be PATCH         |
|        - |            - |         04 |   2104    | Method must be DELETE        |
|        - |            - |         05 |   2105    | Method must be HEAD          |
|        - |            - |         06 |   2106    | Method must be PUT           |

---

## API

The below listed endpoints are always following the schema `{host}/{lang}/{endpoint}`.
- The `{host}` is the hostname of the platform. This is either one of the deployed stages or your local URL.
- The `{lang}` is the language of the platform. For a full list of available languages, see the [defined languages](./config/routes.yaml).
- The `{endpoint}` is the endpoint of the API.

For example, if you are looking at the endpoint `/misc/` the full endpoint will be `{host}/{lang}/misc/`.

The sections below are following the file and directory structure. If you find a MiscController for example under `src/Controller/MiscController.php`, its endpoints are listed under the "[Miscellaneous](#miscellaneous-misccontrollersrccontrollermisccontrollerphp)" section.

### Miscellaneous ([MiscController](src/Controller/MiscController.php))

#### Index

Path: `/misc/`  
Description: Useless index endpoint.  
Methods: `GET`, `POST`, `PATCH`, `DELETE`, `HEAD`, `PUT`  
Params:  
_n/a_  
Body:  
_n/a_  
Response:  
_Default controller body_

#### Create admin user

**Path**: `/misc/create-admin-user`  
**Description**: Creates an admin user if it does'nt exist. Username and Password initially is `admin` and of course needs to be changed later.  
**Methods**: `GET`  
**Params**:  

| Param  | Type     | Description                                                                                                 |
|--------|----------|-------------------------------------------------------------------------------------------------------------|
| `lang` | `string` | Language of the response. For a list of language Options have a look at [routes.yaml](./config/routes.yaml) |

**Response**:  
Code: `200`  
```json
{
  "message": "Admin user created"
}
```

If the admin user already exists:




| Key    | Value                            |
|--------|----------------------------------|
| Path   | `/api/{lang}/misc/`              |
| Method | `GET`, `POST`, `PATCH`, `DELETE` |
| Params | `lang`                           |
