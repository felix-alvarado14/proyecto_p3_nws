<h1>{{SITE_TITLE}}</h1>
<p>Landing Page Administrador</p>

<br>

<h2 class="titulo">Paginas disponibles:</h2>

<form 
        method="POST"
        action="index.php?page=Maintenance-Books-Book&mode={{mode}}&id_libro={{id_libro}}"
        class=""
    >
    <section class="opciones">

        <div class="column">

            <div class="opcion">
                <button class="btnLanding" id="btnUsuarios" type="button">Usuarios</button>
                &nbsp;
           </div>

            <div class="opcion">
                <button class="btnLanding" id="btnInventario" type="button">Inventario</button>
                &nbsp;
           </div>

            <div class="opcion">
                <button class="btnLanding" id="btnCarrito" type="button">Mi Carrito</button>
                &nbsp;
            </div>

             <div class="opcion">
                <button class="btnLanding" id="btnRoles" type="button">Roles</button>
                &nbsp;
            </div>

    </div>

    </section>
    
    
    </form>

<script>
    document.addEventListener("DOMContentLoaded", ()=>{
        document.getElementById("btnUsuarios")
            .addEventListener("click", (e)=>{
                e.preventDefault();
                e.stopPropagation();
                window.location.assign("index.php?page=Maintenance-Usuarios-Usuarios");
            });
    });

    document.addEventListener("DOMContentLoaded", ()=>{
        document.getElementById("btnInventario")
            .addEventListener("click", (e)=>{
                e.preventDefault();
                e.stopPropagation();
                window.location.assign("index.php?page=Maintenance-Books-Books");
            });
    });

        document.addEventListener("DOMContentLoaded", ()=>{
        document.getElementById("btnCarrito")
            .addEventListener("click", (e)=>{
                e.preventDefault();
                e.stopPropagation();
                window.location.assign("index.php?page=Maintenance-Books-Books");
            });
    });

            document.addEventListener("DOMContentLoaded", ()=>{
        document.getElementById("btnRoles")
            .addEventListener("click", (e)=>{
                e.preventDefault();
                e.stopPropagation();
                window.location.assign("index.php?page=Maintenance-Roles-Roles");
            });
    });

</script>