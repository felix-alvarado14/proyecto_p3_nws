<h1>Roles</h1>
<section class="WWList">
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Descripcion</th>
                <th>Estado</th>

                <th>
                    <a href="index.php?page=Maintenance-Admin-Books-Book&mode=INS&id=" class="">New</a>
                </th>

            </tr>
        </thead>
        <tbody>
            {{foreach roles}}
            <tr>
                <td>{{rolescod}}</td>
                <td>{{rolesdsc}}</td>
                <td>{{rolesest}}</td>
                <td>
                    <a href="index.php?page=Maintenance-Admin-Books-Book&mode=UPD&id_libro={{id_libro}}" >
                        Editar
                    </a> &nbsp;
                    <a href="index.php?page=Maintenance-Admin-Books-Book&mode=DSP&id_libro={{id_libro}}" >
                        Ver
                    </a> &nbsp;
                    <a href="index.php?page=Maintenance-Admin-Books-Book&mode=DEL&id_libro={{id_libro}}" >
                        Eliminar
                    </a>
                </td>
            </tr>
            {{endfor roles}}
        </tbody>
    </table>



</section>  

<br>

<button id="btnRolesAsign">Ver Roles Asignados</button>

<button id="btnFunciones">Ver Funciones</button>

<button id="btnFuncionesAsign">Ver Funciones Asignadas</button>


<script>

                    document.addEventListener("DOMContentLoaded", ()=>{
        document.getElementById("btnRolesAsign")
            .addEventListener("click", (e)=>{
                e.preventDefault();
                e.stopPropagation();
                window.location.assign("index.php?page=Maintenance-Admin-RolUsuario-Rolusuario");
            });
    });

                        document.addEventListener("DOMContentLoaded", ()=>{
        document.getElementById("btnFunciones")
            .addEventListener("click", (e)=>{
                e.preventDefault();
                e.stopPropagation();
                window.location.assign("index.php?page=Maintenance-Admin-Funciones-Funciones");
            });
    });

                            document.addEventListener("DOMContentLoaded", ()=>{
        document.getElementById("btnFuncionesAsign")
            .addEventListener("click", (e)=>{
                e.preventDefault();
                e.stopPropagation();
                window.location.assign("index.php?page=Maintenance-Admin-FuncionesRoles-FuncionesRoles");
            });
    });
    
    </script>