# 🛠️ Plataforma de Control d’Incidències Informàtiques

## 📌 Descripció del projecte  
Aquesta aplicació web permet la gestió centralitzada de les incidències informàtiques d'una multinacional amb seus a **Barcelona, Berlín i Montreal**. Els usuaris poden registrar incidències, assignar-les, gestionar-les i resoldre-les segons els seus rols dins del sistema.

---

## 🎯 Objectiu  
Desenvolupar una plataforma que permeti la gestió eficient de les incidències informàtiques, assignació de tasques als tècnics i seguiment de l’estat de cada incidència.

---

## ⚙️ Funcionalitats principals  
### 1️⃣ **Sistema d'autenticació i rols**  
✔️ Login i registre d'usuaris amb Laravel Auth.  
✔️ Validacions de seguretat tant al client com al servidor.  
✔️ Rols disponibles:  
   - 🛡️ **Administrador**: Gestiona usuaris i tipus d’incidències.  
   - 👨‍💼 **Client**: Registra incidències i pot tancar-les.  
   - 📋 **Gestor d’equip**: Assigna incidències als tècnics i estableix prioritats.  
   - 🔧 **Tècnic de manteniment**: Resol incidències i actualitza el seu estat.  

### 2️⃣ **Gestió d'incidències**  
✅ Creació d'incidències amb estat inicial **"Sense assignar"**.  
✅ Assignació d'incidències per part del **gestor d’equip**.  
✅ Control de l'estat de cada incidència:  
   - ⏳ **Sense assignar**  
   - 📌 **Assignada**  
   - 🏗️ **En treball**  
   - ✅ **Resolta**  
   - 🔒 **Tancada**  
✅ Classificació per **categories i subcategories**.  
✅ Filtres per **estat, prioritat i data**.  
✅ Ordenació per **data de creació**.  

### 3️⃣ **Funcionalitats opcionals**  
⭐ Sistema de **missatgeria** entre **client** i **tècnic** per obtenir més informació.  
⭐ Adjuntar **imatges** a les incidències per facilitar-ne el diagnòstic.  

---

## 🛠️ Requisits tècnics  
- **Backend:** Laravel  
- **Frontend:** Blade Templates, Bootstrap/TailwindCSS  
- **Base de dades:** MySQL (gestió amb migracions de Laravel)  
- **AJAX** per a la gestió de CRUDs sense necessitat de recarregar la pàgina.  
- **Control de transaccions** per assegurar la consistència de les dades.  

---

