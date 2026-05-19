# 🗄️ Base de Datos - CineGestor

## Cómo importar la base de datos:

### Requisitos:
- XAMPP con MySQL corriendo
- phpMyAdmin o línea de comandos

### Opción 1: phpMyAdmin (RECOMENDADA)
1. Abrir `http://localhost/phpmyadmin`
2. Crear una base de datos llamada `cine_reservas_db`
3. Seleccionar la base de datos
4. Ir a la pestaña **"Importar"**
5. Hacer clic en **"Examinar"** y seleccionar `cine_reservas_backup.sql`
6. Hacer clic en **"Continuar"**

### Opción 2: Línea de comandos (Windows - Git Bash)
```bash
mysql -u root -p cine_reservas_db < database/backups/cine_reservas_backup.sql
