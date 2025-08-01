<h1>{{SITE_TITLE}}</h1>
<p>Landing Page</p>

<br>

<form 
        method="POST"
        action="index.php?page=Maintenance-Books-Book&mode={{mode}}&id_libro={{id_libro}}"
        class="grid col-12 col-m-8 offset-m-2 col-l-6 offset-l-3"
    >
    
    <div class="row">
            <div class="">
                <button class="btnLanding" id="btnCatalogo" type="button">Catálogo</button>
                &nbsp;
           </div>

               <div class="row">
            <div class="">
                <button class="btnLanding" id="btnTransferencias" type="button">Transferencias</button>
                &nbsp;
           </div>
                       <div class="">
                <button class="btnLanding" id="btnCarrito" type="button">Mi Carrito</button>
                &nbsp;
           </div>
    
    </form>

<script>
    document.addEventListener("DOMContentLoaded", ()=>{
        document.getElementById("btnCatalogo")
            .addEventListener("click", (e)=>{
                e.preventDefault();
                e.stopPropagation();
                window.location.assign("index.php?page=Maintenance-Books-Books");
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