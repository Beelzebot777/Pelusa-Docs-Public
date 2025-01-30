**Resumen y Comandos**

---

### **1. Mantener sesiones activas al cerrar PuTTY**

#### **Usar `tmux`**
- Crear una nueva sesión:
  ```bash
  tmux new -s miservidor
  ```
- Ejecutar el servidor dentro de `tmux`.
- Desvincular sesión sin cerrar el proceso:
  ```bash
  Ctrl + B, luego D
  ```
- Volver a conectar:
  ```bash
  tmux attach -t miservidor
  ```

#### **Usar `screen`**
- Crear una nueva sesión:
  ```bash
  screen -S miservidor
  ```
- Ejecutar el servidor dentro de `screen`.
- Desvincular sesión sin cerrarla:
  ```bash
  Ctrl + A, luego D
  ```
- Volver a conectar:
  ```bash
  screen -r miservidor
  ```

---

### **2. Ejecutar procesos en segundo plano**

#### **Con `&`**
- Ejecutar en background:
  ```bash
  python3 run.py &
  ```
- Ver procesos en segundo plano:
  ```bash
  jobs -l
  ```
- Traer proceso de vuelta al foreground:
  ```bash
  fg %1
  ```

#### **Con `nohup`**
- Ejecutar proceso ignorando cierre de sesión:
  ```bash
  nohup python3 run.py > output.log 2>&1 &
  ```
- Verificar si sigue corriendo:
  ```bash
  ps aux | grep python
  ```
- Matar proceso si es necesario:
  ```bash
  kill -9 PID
  ```

#### **Con `disown`**
- Desasociar proceso del terminal:
  ```bash
  disown -h %1
  ```

---

### **3. Consultar procesos activos**

- Listar todos los procesos:
  ```bash
  ps aux
  ```
- Filtrar procesos específicos (ejemplo: Python):
  ```bash
  ps aux | grep python
  ```
- Ver procesos en background:
  ```bash
  jobs -l
  ```
- Usar `top` para monitorear en tiempo real:
  ```bash
  top
  ```
- Si tienes `htop` instalado (más visual):
  ```bash
  htop
  ```
- Listar sesiones activas en `tmux`:
  ```bash
  tmux ls
  ```
- Restaurar sesión de `tmux`:
  ```bash
  tmux attach -t miservidor
  ```
- Listar sesiones activas en `screen`:
  ```bash
  screen -ls
  ```
- Restaurar sesión de `screen`:
  ```bash
  screen -r miservidor
  ```

---

### **4. Resolver error `Address already in use`**

- Identificar qué proceso usa un puerto (ejemplo: 8000):
  ```bash
  sudo lsof -i :8000
  ```
- Matar el proceso que está bloqueando el puerto:
  ```bash
  kill -9 10025 10027  # Reemplaza con los PIDs reales
  ```
- Verificar si el puerto sigue ocupado:
  ```bash
  sudo lsof -i :8000
  ```
- Reiniciar el servidor:
  ```bash
  python3 run.py
  ```
- Usar otro puerto si es necesario:
  ```bash
  python3 -m uvicorn app:main --host 0.0.0.0 --port 8001
  ```

---

### **5. Editores de código en Linux**

- **Nano** (editor simple en terminal):
  ```bash
  nano archivo.py
  ```
- **Vim** (más avanzado, con comandos personalizados):
  ```bash
  vim archivo.py
  ```
- **Neovim** (mejorado sobre Vim):
  ```bash
  nvim archivo.py
  ```
- **Gedit** (editor gráfico en GNOME):
  ```bash
  gedit archivo.py
  ```
- **VS Code** (editor gráfico más avanzado):
  ```bash
  code archivo.py
  ```

📌 **Conclusión:** Para sesiones persistentes en PuTTY, `tmux` es la mejor opción. Para liberar puertos bloqueados, usa `lsof` y `kill`. Para edición de código, depende de tu preferencia (nano, vim, VS Code). 🚀

