<h1>Books</h1>
<div>

{{foreach books}}
    <div class="product" data-id_libro="{{id_libro}}">
        <h2>{{titulo}}</h2>
        <p>Autor: {{autor}}</p>
        <p>Género: {{genero}}</p>
        <p>Año: {{publicacion_year}}</p>
        <p>Editorial: {{editora}}</p>
        <p>Precio: L {{precio}}</p>
        
        <button class="add-to-cart" onclick="verDetalles({{id_libro}})">Agregar al carrito</button>
    </div>
{{endfor books}}

</div>

<script>
    function verDetalles(idLibro){
        window.location.href = `index.php?page=Maintenance-Catalogo-Individual&id_libro=${idLibro}`;
    }
</script>
