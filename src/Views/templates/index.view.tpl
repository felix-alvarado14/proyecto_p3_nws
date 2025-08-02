<h1>{{SITE_TITLE}}</h1>
<p>Landing Page Cliente</p>

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
                <button class="btnLanding" id="btnCatalogo" type="button">Catálogo</button>
                &nbsp;
           </div>

           <br>

            <div class="opcion">
                <button class="btnLanding" id="btnTransferencias" type="button">Historial Transferencias</button>
                &nbsp;
           </div>

           <br>

            <div class="opcion">
                <button class="btnLanding" id="btnCarrito" type="button">Mi Carrito</button>
                &nbsp;
            </div>

        </div>

    </section>
    
    
    </form>

<script>
    document.addEventListener("DOMContentLoaded", ()=>{
        document.getElementById("btnCatalogo")
            .addEventListener("click", (e)=>{
                e.preventDefault();
                e.stopPropagation();
                window.location.assign("index.php?page=Maintenance-Cliente-Catalogo-Catalogo");
            });
    });

    document.addEventListener("DOMContentLoaded", ()=>{
        document.getElementById("btnTransferencias")
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

</script>