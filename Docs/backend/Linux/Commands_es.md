## ✅ Resumen de comandos utilizados en la configuración de EC2 con FastAPI y Uvicorn

### **1. Conectarse a la instancia EC2 con PuTTY**
```bash
# Usuario por defecto en Ubuntu
login as: ubuntu
```

---

### **2. Actualizar el sistema y preparar el entorno**
```bash
sudo apt update && sudo apt upgrade -y
sudo apt install -y python3 python3-pip python3-venv git
```
```bash
python3 --version
pip3 --version
git --version
```

---

### **3. Clonar repositorios desde GitHub**
```bash
cd ~
mkdir projects && cd projects
git clone <URL_DEL_REPO>
ls -l  # Verificar que se clonaron correctamente
```

---

### **4. Crear y activar entornos virtuales**
```bash
cd ~/projects/Pelusa-BackEnd-AlarmHugger
python3 -m venv venv
source venv/bin/activate
pip install -r requirements.txt
```
Para el otro backend:
```bash
cd ~/projects/Pelusa-BackEnd-Strateger-Public
python3 -m venv venv
source venv/bin/activate
pip install -r requirements.txt
```

---

### **5. Iniciar los servidores Uvicorn**
```bash
python3 run.py
```
Si da error de permisos con el puerto `80`, cambiar a `8000` en `run.py`:
```python
uvicorn.run("app.main:app", host="0.0.0.0", port=8000, reload=True, log_level="debug")
```

---

### **6. Manejo de procesos en la terminal**
```bash
CTRL + Z   # Pausar un proceso
bg         # Enviarlo a segundo plano
fg         # Traerlo de vuelta al frente
python3 run.py &  # Ejecutar en segundo plano desde el inicio
jobs -l    # Listar procesos en segundo plano
kill %1    # Terminar un proceso en segundo plano
```

---

### **7. Navegación en la terminal**
```bash
cd ..   # Ir una carpeta atrás
pwd     # Mostrar la ruta actual
ls -l   # Listar archivos en el directorio
find . -name "run.py"  # Buscar un archivo dentro del proyecto
```

---

### **8. Editar archivos en la terminal**
```bash
nano run.py  # Abrir un archivo en nano
CTRL + X  # Salir de nano
Y  # Confirmar guardar cambios
Enter  # Guardar
```
```bash
vim run.py  # Abrir archivo en Vim
i  # Modo edición
ESC  # Salir del modo edición
:wq  # Guardar y salir
```

---

### **9. Configurar variables de entorno con `.env`**
```bash
nano .env
```
Agregar variables:
```ini
DATABASE_URL_DESARROLLO_ALARMAS="mysql://usuario:contraseña@host:puerto/db_name"
```
```bash
source .env  # Cargar variables en la terminal
echo $DATABASE_URL_DESARROLLO_ALARMAS  # Verificar si se cargó
```

---

### **10. Multiplexar terminales (Ejecutar múltiples sesiones)**
Abrir una nueva sesión de `tmux`:
```bash
tmux new -s server1
```
Crear una nueva ventana dentro de `tmux`:
```bash
CTRL + B, luego presiona C
```
Cambiar entre ventanas:
```bash
CTRL + B, luego presiona N
```
Volver a una sesión `tmux`:
```bash
tmux attach -t server1
```
Listar sesiones activas:
```bash
tmux ls
```

---

### **11. Solucionar error de conexión con MySQL**
Verificar credenciales en `.env`:
```bash
nano .env
```
Si aún falla, probar conexión manual desde EC2:
```bash
mysql -u usuario -p -h host -P 3306
```
Si MySQL no permite acceso remoto, conceder permisos en la base de datos:
```sql
GRANT ALL PRIVILEGES ON mydatabase.* TO 'usuario'@'%' IDENTIFIED BY 'contraseña';
FLUSH PRIVILEGES;
```

---
## 12. Solución recomendada: Usar iptables para redirigir el puerto 80 al 8000

Ya que `setcap` no está funcionando, la mejor solución es redirigir el tráfico del **puerto 80** al **puerto 8000**:

```bash
sudo iptables -t nat -A PREROUTING -p tcp --dport 80 -j REDIRECT --to-port 8000


