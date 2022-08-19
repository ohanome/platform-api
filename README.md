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

## API

### Miscellaneous

`/api/{lang}/misc/`