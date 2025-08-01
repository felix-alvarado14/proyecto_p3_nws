<section class="depth-2 px-4 py-5">
    <h2>{{modeDsc}}</h2>
</section>
<section class="depth-2 px-4 py-4 my-4 grid row">
   <form 
        method="POST"
        action="index.php?page=Maintenance-Books-Book&mode={{mode}}&id_libro={{id_libro}}"
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
            <label for="titulo" class="col-12 col-m-4 col-l-3">Title:</label>
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
            <label for="autor" class="col-12 col-m-4 col-l-3">Author:</label>
            <input 
                type="text"
                name="autor"
                id="autor"
                value="{{autor}}"
                placeholder="Author"
                class="col-12 col-m-8 col-l-9"
                {{readonly}}
             />
             {{foreach errors_autor}}
                <div class="error col-12">{{this}}</div>
             {{endfor errors_autor}}
        <div class="row my-2">
            <label for="genero" class="col-12 col-m-4 col-l-3">Genre:</label>
            <input 
                type="text"
                name="genero"
                id="genero"
                value="{{genero}}"
                placeholder="Genre"
                class="col-12 col-m-8 col-l-9"
                {{readonly}}
             />
             {{foreach errors_genero}}
                <div class="error col-12">{{this}}</div>
             {{endfor errors_genero}}
        <div class="row my-2">
            <label for="publicacion_year" class="col-12 col-m-4 col-l-3">Published year:</label>
            <input 
                type="text"
                name="publicacion_year"
                id="publicacion_year"
                value="{{publicacion_year}}"
                placeholder="Published year"
                class="col-12 col-m-8 col-l-9"
                {{readonly}}
             />
             {{foreach errors_ano}}
                <div class="error col-12">{{this}}</div>
             {{endfor errors_ano}}
        <div class="row my-2">
            <label for="editora" class="col-12 col-m-4 col-l-3">Publisher:</label>
            <input 
                type="text"
                name="editora"
                id="editora"
                value="{{editora}}"
                placeholder="Publisher"
                class="col-12 col-m-8 col-l-9"
                {{readonly}}
             />
             {{foreach errors_editora}}
                <div class="error col-12">{{this}}</div>
             {{endfor errors_editora}}
        </div>
        <div class="row my-2">
            <label for="precio" class="col-12 col-m-4 col-l-3">Price:</label>
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
                <button class="" id="btnCancel" type="button">{{cancelLabel}}</button>
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
<script>
    document.addEventListener("DOMContentLoaded", ()=>{
        document.getElementById("btnCancel")
            .addEventListener("click", (e)=>{
                e.preventDefault();
                e.stopPropagation();
                window.location.assign("index.php?page=Maintenance-Books-Books");
            });
    });
</script>