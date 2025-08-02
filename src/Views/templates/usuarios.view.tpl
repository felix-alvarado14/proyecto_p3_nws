<h1>Usuarios</h1>
<section class="WWList">
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Email</th>
                <th>Nombre</th>
                <th>Contraseña</th>
                <th>Creación</th>
                <th>Estado Contraseña</th>
                <th>Expiración Contraseña</th>
                <th>Estado Usuario</th>
                <th>Codigo Actualización</th>
                <th>Ultimo Cambio Contraseña</th>
                <th>Tipo de Usuario</th>
                <th>
                    <a href="index.php?page=Maintenance-Books-Book&mode=INS&id=" class="">New</a>
                </th>
            </tr>
        </thead>
        <tbody>
            {{foreach usuarios}}
            <tr>
                <td>{{usercod}}</td>
                <td>{{useremail}}</td>
                <td>{{username}}</td>
                <td>{{userpswd}}</td>
                <td>{{userfching}}</td>
                <td>{{userpswdest}}</td>
                <td>{{userpswdexp}}</td>
                <td>{{userest}}</td>
                <td>{{useractcod}}</td>
                <td>{{userpswdchg}}</td>
                <td>{{usertipo}}</td>
                <td>
                    <a href="index.php?page=Maintenance-Usuarios-Usuario&mode=UPD&usercod={{usercod}}" >
                        Editar
                    </a> &nbsp;
                    <a href="index.php?page=Maintenance-Usuarios-Usuario&mode=DSP&usercod={{usercod}}" >
                        Ver
                    </a> &nbsp;
                    <a href="index.php?page=Maintenance-Usuarios-Usuario&mode=DEL&usercod={{usercod}}" >
                        Eliminar
                    </a>
                </td>
            </tr>
            {{endfor usuarios}}
        </tbody>
    </table>
</section>