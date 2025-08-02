<h1>Funciones</h1>
<section class="WWList">
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Descripcion</th>
                <th>Estado</th>
                <th>Tipo</th>

                <th>
                    <a href="index.php?page=Maintenance-Admin-Funciones-Funcion&mode=INS&id=" class="">New</a>
                </th>

            </tr>
        </thead>
        <tbody>
            {{foreach funciones}}
            <tr>
                <td>{{fncod}}</td>
                <td>{{fndsc}}</td>
                <td>{{fnest}}</td>
                <td>{{fntyp}}</td>
                <td>
                    <a href="index.php?page=Maintenance-Admin-Funciones-Funcion&mode=UPD&fncod={{fncod}}" >
                        Editar
                    </a> &nbsp;
                    <a href="index.php?page=Maintenance-Admin-Funciones-Funcion&mode=DSP&fncod={{fncod}}" >
                        Ver
                    </a> &nbsp;
                    <a href="index.php?page=Maintenance-Admin-Funciones-Funcion&mode=DEL&fncod={{fncod}}" >
                        Eliminar
                    </a>
                </td>
            </tr>
            {{endfor funciones}}
        </tbody>
    </table>



</section>  

<br>


<script>

                    document.addEventListener("DOMContentLoaded", ()=>{
        document.getElementById("btnRolesAsign")
            .addEventListener("click", (e)=>{
                e.preventDefault();
                e.stopPropagation();
                window.location.assign("index.php?page=Maintenance-Admin-RolUsuario-Rolusuario");
            });
    });
    
    </script>