# Trabajo Práctico Especial - WEB 2 - TUDAI - UNICEN

Este proyecto consiste en el diseño y desarrollo de un sitio web para mostrar y administrar una base de datos relacional de una inmobiliaria. El objetivo es gestionar propiedades inmobiliarias y permitir la visualización de las mismas.

### Funcionalidades:
- Los **administradores** podrán **crear**, **actualizar**, **borrar** y **eliminar** propiedades.
- Los **usuarios** tendrán acceso únicamente a la **visualización** de las propiedades.

## Modelo de Datos

Las entidades principales de la base de datos son **propiedades** y **dueños**. Para cada una se construyó una tabla con sus respectivos atributos. 

- **Tabla propiedades**: Contiene información sobre las propiedades inmobiliarias.
- **Tabla dueños**: Almacena información sobre los dueños de las propiedades.

La relación entre estas tablas es de **1 a N**, lo que significa que un dueño puede tener múltiples propiedades, pero una propiedad solo puede pertenecer a un dueño.

### Atributos de la tabla `duenio`:
- `id_duenio`: `int(11)` (Primary key)
- `nombre`: `varchar(50)`
- `telefono`: `varchar(20)`
- `email`: `varchar(80)`

### Atributos de la tabla `propiedad`:
- `id_propiedad`: `int(11)` (Primary key)
- `tipo`: `varchar(20)`
- `zona`: `varchar(45)`
- `precio`: `decimal(10,0)`
- `descripcion`: `varchar(500)`
- `modalidad`: `varchar(20)`
- `estado`: `varchar(20)`
- `localidad`: `varchar(45)`
- `id_duenio`: `int(11)` (Foreign key que referencia a la tabla `duenio`)

Estos atributos y relaciones permiten modelar la relación entre los dueños y sus propiedades en la base de datos.

## Diagrama de Datos

![Modelo Entidad-Relación](./images/mer.png)
![Modelo Entidad-Relación Alternativo](./images/modeloentidadrelacion.png)

## Agradecimientos

Queremos agradecer a los docentes y ayudantes de la cátedra, así como a la universidad pública por su apoyo.

## Autores

- [Diego Santellán](https://www.linkedin.com/in/diego-santellan/)
- [Lis Medina](https://www.linkedin.com/in/lis-medina/)