<section class="depth-2 px-4 py-5">
    <h2>{{modeDsc}}</h2>
</section>

<section class="depth-2 px-4 py-4 my-4 grid row">
    <form 
        method="POST"
        action="index.php?page=Maintenance-Users-User&mode={{mode}}&usercod={{usercod}}"
        class="grid col-12 col-m-8 offset-m-2 col-l-6 offset-l-3"
    >
        <div class="row my-2">
            <label for="usercod" class="col-12 col-m-4 col-l-3">ID:</label>
            <input 
                type="text"
                name="usercod"
                id="usercod"
                value="{{usercod}}"
                placeholder="Código de usuario"
                class="col-12 col-m-8 col-l-9"
                readonly
            />
            <input type="hidden" name="xsrtoken" value="{{xsrtoken}}" />
        </div>

        <div class="row my-2">
            <label for="usermail" class="col-12 col-m-4 col-l-3">Correo electrónico:</label>
            <input 
                type="email"
                name="usermail"
                id="usermail"
                value="{{usermail}}"
                placeholder="usuario@ejemplo.com"
                class="col-12 col-m-8 col-l-9"
                {{readonly}}
            />
            {{foreach errors_usermail}}
                <div class="error col-12">{{this}}</div>
            {{endfor errors_usermail}}
        </div>

        <div class="row my-2">
            <label for="username" class="col-12 col-m-4 col-l-3">Nombre completo:</label>
            <input 
                type="text"
                name="username"
                id="username"
                value="{{username}}"
                placeholder="Nombre del usuario"
                class="col-12 col-m-8 col-l-9"
                {{readonly}}
            />
            {{foreach errors_username}}
                <div class="error col-12">{{this}}</div>
            {{endfor errors_username}}
        </div>

        <div class="row my-2">
            <label for="userpswd" class="col-12 col-m-4 col-l-3">Contraseña:</label>
            <input 
                type="text"
                name="userpswd"
                id="userpswd"
                value="{{userpswd}}"
                placeholder="Contraseña"
                class="col-12 col-m-8 col-l-9"
                {{readonly}}
            />
            {{foreach errors_userpswd}}
                <div class="error col-12">{{this}}</div>
            {{endfor errors_userpswd}}
        </div>

        <div class="row my-2">
            <label for="userfching" class="col-12 col-m-4 col-l-3">Fecha de creación:</label>
            <input 
                type="date"
                name="userfching"
                id="userfching"
                value="{{userfching}}"
                class="col-12 col-m-8 col-l-9"
                {{readonly}}
            />
            {{foreach errors_userfching}}
                <div class="error col-12">{{this}}</div>
            {{endfor errors_userfching}}
        </div>

        <div class="row my-2">
            <label for="userpswdest" class="col-12 col-m-4 col-l-3">Estado de contraseña:</label>
            <input 
                type="text"
                name="userpswdest"
                id="userpswdest"
                value="{{userpswdest}}"
                placeholder="Estado"
                class="col-12 col-m-8 col-l-9"
                {{readonly}}
            />
            {{foreach errors_userpswdest}}
                <div class="error col-12">{{this}}</div>
            {{endfor errors_userpswdest}}
        </div>

        <div class="row my-2">
            <label for="userpswdexp" class="col-12 col-m-4 col-l-3">Expiración de contraseña:</label>
            <input 
                type="date"
                name="userpswdexp"
                id="userpswdexp"
                value="{{userpswdexp}}"
                class="col-12 col-m-8 col-l-9"
                {{readonly}}
            />
            {{foreach errors_userpswdexp}}
                <div class="error col-12">{{this}}</div>
            {{endfor errors_userpswdexp}}
        </div>

        <div class="row">
            <div class="col-12 right">
                <button class="" id="btnCancel" type="button">{{cancelLabel}}</button>
                &nbsp;
                {{if showConfirm}}
                    <button class="primary" type="submit">Confirmar</button>
                {{endif showConfirm}}
            </div>
        </div>

        {{if errors_global}}
            <div class="row">
                <ul class="col-12">
                {{foreach errors_global}}
                    <li class="error">{{this}}</li>
                {{endfor errors_global}}
                </ul>
            </div>
        {{endif errors_global}}
    </form>
</section>

<script>
    document.addEventListener("DOMContentLoaded", ()=>{
        document.getElementById("btnCancel")
            .addEventListener("click", (e)=>{
                e.preventDefault();
                e.stopPropagation();
                window.location.assign("index.php?page=Maintenance-Admin-Usuarios-Usuarios");
            });
    });
</script>
