<section class="depth-2 px-4 py-5">
    <h2>{{modeDsc}}</h2>
</section>
<section class="depth-2 px-4 py-4 my-4 grid row">
   <form 
        method="POST"
        action="index.php?page=Maintenance-Catalogo-Individual&id_libro={{id_libro}}"
        class="grid col-12 col-m-8 offset-m-2 col-l-6 offset-l-3"
    >
        <div class="row my-2">
            <label for="id_libro" class="col-12 col-m-4 col-l-3">Id:</label>
            <input 
                type="text"
                name="id_libro"
                id="id_libro"
                value="{{id_libro}}"
                placeholder="Book Id"
                class="col-12 col-m-8 col-l-9"
                readonly
             />
             <input type="hidden" name="xsrtoken" value="{{xsrtoken}}" />
        </div>
        <div class="row my-2">
            <label for="titulo" class="col-12 col-m-4 col-l-3">Titulo del libro:</label>
            <input 
                type="text"
                name="titulo"
                id="titulo"
                value="{{titulo}}"
                placeholder="Book's title"
                class="col-12 col-m-8 col-l-9"
                {{readonly}}
             />
             {{foreach errors_titulo}}
                <div class="error col-12">{{this}}</div>
             {{endfor errors_titulo}}
        </div>
        <div class="row my-2">
            <label for="precio" class="col-12 col-m-4 col-l-3">Precio:</label>
            <input 
                type="text"
                name="precio"
                id="precio"
                value="{{precio}}"
                placeholder="Price"
                class="col-12 col-m-8 col-l-9"
                {{readonly}}
             />
             {{foreach errors_editora}}
                <div class="error col-12">{{this}}</div>
             {{endfor errors_editora}}
        </div>
        <div class="row">
            <div class="col-12 right">
                &nbsp;
                {{if showConfirm}}
                    <button class="primary" type="submit">Confirm</button>
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

<section>

    <h2>Desea Agregar al Carrito?</h2>

<form method="POST" action="index.php?page=Maintenance-Cliente-Catalogo-AgregarTemp">
    <input type="hidden" name="id_libro" value="{{id_libro}}">
    <input type="hidden" name="titulo" value="{{titulo}}">
    <input type="hidden" name="precio" value="{{precio}}">
    <button type="submit">Aceptar</button>
    <button id="btnCancel" type="button">Cancelar</button>
</form>


</section>


<script>
    document.addEventListener("DOMContentLoaded", ()=>{
        document.getElementById("btnCancel")
            .addEventListener("click", (e)=>{
                e.preventDefault();
                e.stopPropagation();
                window.location.assign("index.php?page=Maintenance-Cliente-Catalogo-Catalogo");
            });
    });
</script>