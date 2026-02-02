## Menciones de lo que hay que incluir
### BD / Modelos
Al hacer un modelo mencionar el comando:  
`php artisan make:model Project --all`

Luego en rutas añadir la linea:  
`Route::model("/project", ProjectController::class);`

Sirve para generar las rutas estandar para una api segun la especificación.

Luego si quiero ver esas rutas este comando (creo):  
`php artisan route:list --name="projects""` 