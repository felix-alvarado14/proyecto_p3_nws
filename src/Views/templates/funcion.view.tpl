<section class="depth-2 px-4 py-5">
    <h2>{{modeDsc}}</h2>
</section>
<section class="depth-2 px-4 py-4 my-4 grid row">
   <form 
        method="POST"
        action="index.php?page=Maintenance-Funciones-Funcion&fncod={{fncod}}"
        class="grid col-12 col-m-8 offset-m-2 col-l-6 offset-l-3"
    >
        <div class="row my-2">
            <label for="fncod" class="col-12 col-m-4 col-l-3">Código:</label>
            <input 
                type="text"
                name="fncod"
                id="fncod"
                value="{{fncod}}"
                placeholder="Function Code"
                class="col-12 col-m-8 col-l-9"
                readonly
             />
             <input type="hidden" name="xsrtoken" value="{{xsrtoken}}" />
        </div>
        <div class="row my-2">
            <label for="fndsc" class="col-12 col-m-4 col-l-3">Descripción:</label>
            <input 
                type="text"
                name="fndsc"
                id="fndsc"
                value="{{fndsc}}"
                placeholder="Function Description"
                class="col-12 col-m-8 col-l-9"
                {{readonly}}
             />
             {{foreach errors_fndsc}}
                <div class="error col-12">{{this}}</div>
             {{endfor errors_fndsc}}
        </div>
        <div class="row my-2">
            <label for="fnest" class="col-12 col-m-4 col-l-3">Estado:</label>
            <select
                name="fnest"
                id="fnest"
                class="col-12 col-m-8 col-l-9"
                {{readonly}}
            >
                <option value="ACT" {{fnest_ACT}}>Activo</option>
                <option value="INA" {{fnest_INA}}>Inactivo</option>
            </select>
             {{foreach errors_fnest}}
                <div class="error col-12">{{this}}</div>
             {{endfor errors_fnest}}
        </div>
        <div class="row">
            <div class="col-12 right">
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
