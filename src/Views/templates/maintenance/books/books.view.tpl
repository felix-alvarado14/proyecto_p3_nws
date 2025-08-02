<h1>Books</h1>
<section class="WWList">
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Title</th>
                <th>Author</th>
                <th>Genre</th>
                <th>Published Date</th>
                <th>Publisher</th>
                <th>Price</th>
                <th>
                    <a href="index.php?page=Maintenance-Admin-Books-Book&mode=INS&id=" class="">New</a>
                </th>
            </tr>
        </thead>
        <tbody>
            {{foreach books}}
            <tr>
                <td>{{id_libro}}</td>
                <td>{{titulo}}</td>
                <td>{{autor}}</td>
                <td>{{genero}}</td>
                <td>{{publicacion_year}}</td>
                <td>{{editora}}</td>
                <td>{{precio}}</td>
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
            {{endfor books}}
        </tbody>
    </table>
</section>