# Laravel - Todo App Server

Servidor api para  listar, ver, crear, actualizar y eliminar tareas de una lista.


Para probar se puede probar ejecutando 
## Project setup
```
cd proyect && composer install
```

## Levantar servidor local de desarrollo

```
php artisan serve
```
Esto lanzará un servidor local en [http://localhost:8000](http://localhost:8000)


## Rutas

### Listar
GET
Request
```
http://localhost:8000/api/task
```
Response: lista de tareas ordenadas por prioridad
```
{
  "status": "OK",
  "data": [
    {
      "id": 12,
      "title": "Task 7",
      "description": "Description from task 7",
      "priority": "5"
    },
    {
      "id": 11,
      "title": "Task 6",
      "description": "Description from task 5",
      "priority": "4"
    },
    {
      "id": 10,
      "title": "Task 4",
      "description": "Description from task 4",
      "priority": "3"
    }

  ]
}
```

#### Ver

GET
Request
```
http://localhost:8000/api/task/{id]
```
Response: Información de una tarea en concreto
```
{
  "status": "OK",
  "data": [
    {
      "id": 11,
      "title": "Task 6",
      "description": "Description from task 5",
      "priority": "4"
    }
  ]
}
```

#### Crear

POST
Request

```
http://localhost:8000/api/task/

Body form-data:
id: null
title: String
description: String
priority: Int
```
Response: Información de una tarea en concreto
```
{
  "status": "OK",
  "data": [
    {
      "id": 11,
      "title": "Task 6",
      "description": "Description from task 5",
      "priority": "4"
    }
  ]
}
```

#### Actualizar una tarea

POST
Request

```
http://localhost:8000/api/task/{id}

Body form-data:
id: Int
title: String
description: String
priority: Int
```
Response: Datos de la tarea actualizada
```
{
  "status": "OK",
  "data": [
    {
      "id": 11,
      "title": "Task 6",
      "description": "Description from task 6",
      "priority": "4"
    }
  ]
}
```

#### Eliminar una tarea

DELETE
Request

```
http://localhost:8000/api/task/{id}

```
Response: Datos de la tarea actualizada
```
{
    "status": "OK",
    "data": {
        "id": "2"
    }
}
```
