# 📋 Sistema de Gestión de Empleados con QR

Sistema web desarrollado en Laravel para la gestión de empleados con generación automática de códigos QR personalizados.

## 🚀 Características

- ✅ **Gestión de Empleados**: CRUD completo (Crear, Leer, Actualizar, Eliminar)
- 🔍 **Búsqueda y Filtros**: Filtrado de empleados por nombre/apellido
- 📱 **Generación de Códigos QR**: Creación automática de códigos QR únicos para cada empleado
- 👁️ **Visualización de QR**: Modal para visualizar el código QR generado
- 🗃️ **Gestión de Estados**: Sistema de activación/desactivación de empleados (soft delete)
- 📊 **Auditoría**: Registro de fechas y usuarios de creación/modificación
- 🎨 **Interfaz Moderna**: UI responsive con Bootstrap 5 y SweetAlert2

## 🛠️ Tecnologías Utilizadas

- **Backend**: Laravel 9+
- **Frontend**: Bootstrap 5, JavaScript (Vanilla)
- **Base de Datos**: MySQL
- **Generación de QR**: SimpleSoftwareIO/simple-qrcode
- **Alertas**: SweetAlert2

## 📋 Requisitos Previos

- PHP >= 8.0
- Composer
- MySQL >= 5.7
- Node.js y NPM (opcional, para compilación de assets)

## 🔧 Instalación

### 1. Clonar el repositorio

```bash
git clone https://github.com/jenruco/qr-empleados.git
cd qr-empleados
```

### 2. Instalar dependencias de PHP

```bash
composer install
```

### 3. Configurar el archivo de entorno

```bash
cp .env.example .env
```

Edita el archivo `.env` y configura tu base de datos:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nombre_de_tu_base_de_datos
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_contraseña
```

### 4. Ejecutar las migraciones

```bash
php artisan migrate
```

### 5. Crear la carpeta pública para QR

```bash
mkdir -p public/qrs
chmod 755 public/qrs
```

### 6. Iniciar el servidor de desarrollo

```bash
php artisan serve
```

La aplicación estará disponible en: `http://localhost:8000`

## 📁 Estructura del Proyecto

```
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       └── EmpleadoController.php    # Controlador principal
│   └── Models/
│       ├── Empleado.php                   # Modelo de Empleado
│       └── QrEmpleado.php                 # Modelo de QR
├── database/
│   └── migrations/
│       └── 2026_02_06_212643_create_empleados_table.php
├── public/
│   ├── qrs/                               # Almacenamiento de códigos QR
│   └── js/
│       └── empleados.js                   # JavaScript del módulo
├── resources/
│   └── views/
│       └── empleados/
│           └── empleado.blade.php         # Vista principal
└── routes/
    └── web.php                            # Definición de rutas
```

## 🗄️ Estructura de Base de Datos

### Tabla: `empleados`

| Campo        | Tipo         | Descripción                      |
| ------------ | ------------ | -------------------------------- |
| id           | BIGINT       | ID único (PK)                    |
| nombres      | VARCHAR(255) | Nombres del empleado             |
| apellidos    | VARCHAR(255) | Apellidos del empleado           |
| departamento | VARCHAR(100) | Departamento al que pertenece    |
| email        | VARCHAR(255) | Correo electrónico               |
| telefono     | VARCHAR(20)  | Número de teléfono               |
| estado       | BOOLEAN      | 1=Activo, 0=Inactivo             |
| fe_creacion  | TIMESTAMP    | Fecha de creación                |
| usr_creacion | VARCHAR(100) | Usuario que creó el registro     |
| fe_ult_mod   | TIMESTAMP    | Fecha de última modificación     |
| usr_ult_mod  | VARCHAR(100) | Usuario que modificó el registro |

### Tabla: `qr_empleados`

| Campo        | Tipo         | Descripción                      |
| ------------ | ------------ | -------------------------------- |
| id           | BIGINT       | ID único (PK)                    |
| empleado_id  | BIGINT       | ID del empleado (FK)             |
| qr_imagen    | VARCHAR(500) | Ruta de la imagen QR             |
| estado       | BOOLEAN      | 1=Activo, 0=Inactivo             |
| fe_creacion  | TIMESTAMP    | Fecha de creación                |
| usr_creacion | VARCHAR(100) | Usuario que creó el registro     |
| fe_ult_mod   | TIMESTAMP    | Fecha de última modificación     |
| usr_ult_mod  | VARCHAR(100) | Usuario que modificó el registro |

## 🔌 API / Rutas Principales

| Método | Ruta               | Descripción                   |
| ------ | ------------------ | ----------------------------- |
| GET    | `/`                | Lista de empleados            |
| POST   | `/guardar`         | Crear nuevo empleado          |
| DELETE | `/eliminar/{id}`   | Eliminar (inactivar) empleado |
| POST   | `/generar-qr`      | Generar QR para empleados     |
| GET    | `/obtener-qr/{id}` | Obtener QR de un empleado     |

## 💡 Funcionalidades Principales

### Registrar Nuevo Empleado

1. Click en el botón "Nuevo Empleado"
2. Llenar el formulario con los datos requeridos
3. Click en "Guardar Empleado"
4. Se muestra confirmación de éxito

### Generar Código QR

1. Seleccionar uno o varios empleados usando los checkboxes
2. Click en "Generar QR"
3. Los códigos QR se generan automáticamente en formato SVG
4. Se almacenan en `public/qrs/empleado_{id}.svg`

### Ver Código QR

1. Click en el botón "Ver QR" del empleado deseado
2. Se abre un modal mostrando el código QR generado
3. El QR contiene el identificador único del empleado

### Eliminar Empleado

1. Click en el botón "Eliminar" del empleado
2. Confirmar la acción en la alerta de SweetAlert
3. El empleado se marca como inactivo (soft delete)

### Buscar Empleados

1. Ingresar el nombre o apellido en el campo de búsqueda
2. Los resultados se filtran automáticamente

## 🎨 Capturas de Pantalla

_Aquí puedes agregar capturas de pantalla de tu aplicación_

## 🔐 Seguridad

- ✅ Protección CSRF en todos los formularios
- ✅ Validación de datos en el servidor
- ✅ Soft delete para mantener histórico
- ✅ Auditoría de cambios (usuario y fecha)

## 🚧 Mejoras Futuras

- [ ] Sistema de autenticación de usuarios
- [ ] Exportación de datos a Excel/PDF
- [ ] Carga masiva de empleados via CSV
- [ ] Dashboard con estadísticas
- [ ] API RESTful completa
- [ ] Descarga de códigos QR en diferentes formatos
- [ ] Impresión masiva de credenciales con QR
- [ ] Paginación de resultados

## 🤝 Contribuciones

Las contribuciones son bienvenidas. Para cambios importantes:

1. Fork el proyecto
2. Crea una rama para tu feature (`git checkout -b feature/AmazingFeature`)
3. Commit tus cambios (`git commit -m 'Add some AmazingFeature'`)
4. Push a la rama (`git push origin feature/AmazingFeature`)
5. Abre un Pull Request

## 📝 Licencia

Este proyecto está bajo la Licencia MIT. Ver el archivo `LICENSE` para más detalles.

## 👤 Autor

**Henry Pérez**

- GitHub: [@jenruco](https://github.com/jenruco)
- Email: henry_5198@hotmail.com

## 📞 Soporte

Si tienes alguna pregunta o problema, por favor abre un [issue](https://github.com/jenruco/qr-empleados/issues).

---

⭐ Si este proyecto te fue útil, considera darle una estrella en GitHub!
