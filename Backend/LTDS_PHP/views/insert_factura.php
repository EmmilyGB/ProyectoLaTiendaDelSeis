<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Crear Factura</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/tables.css">
</head>
<body>
<div class="wrapper-box">
    <h2>Crear Factura</h2>

    <?php if (!empty($_SESSION['error'])): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($_SESSION['error']); unset($_SESSION['error']); ?></div>
    <?php endif; ?>

    <form id="addForm">
        <div class="row g-2 align-items-end">
            <div class="col-md-4">
                <label>Producto</label>
                <input type="text" id="productoSearch" class="form-control mb-2" placeholder="Buscar producto...">
                <select id="productoBase" class="form-select">
                    <?php foreach ($productos as $p): ?>
                        <option value="<?= (int)$p['IdProducto'] ?>">
                            <?= htmlspecialchars($p['Nombre']) ?> - $<?= number_format((float)$p['Precio'], 0, ',', '.') ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="col-md-3">
                <label>Talla</label>
                <select id="IdProducto" class="form-select"></select>
            </div>

            <div class="col-md-2">
                <label>Cantidad</label>
                <input type="number" id="Cantidad" class="form-control" value="1" min="1">
            </div>

            <div class="col-md-2">
                <label>Cliente</label>
                <input type="text" id="clienteSearch" class="form-control mb-2" placeholder="Buscar cliente...">
                <select id="NumDoc" class="form-select">
                    <option value="">-- Selecciona cliente --</option>
                    <?php foreach ($clientes as $c): ?>
                        <option value="<?= htmlspecialchars($c['NumDoc']) ?>">
                            <?= htmlspecialchars($c['NombreCom']) ?> (<?= htmlspecialchars($c['NumDoc']) ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="col-md-1">
                <button type="button" id="btnAdd" class="btn btn-primary w-100">Agregar</button>
            </div>
        </div>
    </form>

    <hr>

    <h4>Carrito</h4>
    <div class="table-responsive">
        <table class="table cart-table">
            <thead>
                <tr><th>Producto</th><th>Talla</th><th>Precio</th><th>Cant.</th><th>Subtotal</th><th></th></tr>
            </thead>
            <tbody id="cartBody">
                <tr><td colspan="6" class="text-muted">No hay items</td></tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4" class="text-end"><strong>Total</strong></td>
                    <td id="cartTotal">$0</td>
                    <td></td>
                </tr>
            </tfoot>
        </table>
    </div>

    <div class="row g-2 align-items-end">
        <div class="col-md-12 d-flex gap-2">
            <button id="btnSave" class="btn btn-success">Guardar Factura</button>
            <a href="index.php?action=dashboard" class="btn btn-secondary">Volver</a>
        </div>
    </div>
</div>

<script>
let cartState = {};
const variantesMap = <?= json_encode($variantesPorProducto ?? [], JSON_UNESCAPED_UNICODE) ?>;
const productoSearch = document.getElementById('productoSearch');
const clienteSearch = document.getElementById('clienteSearch');
const productoBase = document.getElementById('productoBase');
const tallaSelect = document.getElementById('IdProducto');
const clienteSelect = document.getElementById('NumDoc');

function filtrarSelect(selectEl, texto, mantenerPrimera) {
    const q = (texto || '').trim().toLowerCase();
    Array.from(selectEl.options).forEach((opt, idx) => {
        if (mantenerPrimera && idx === 0) {
            opt.hidden = false;
            return;
        }
        opt.hidden = q !== '' && !opt.text.toLowerCase().includes(q);
    });
}

function renderTallas() {
    const idBase = productoBase.value;
    const variantes = variantesMap[idBase] || [];
    tallaSelect.innerHTML = '';

    if (!variantes.length) {
        const opt = document.createElement('option');
        opt.value = '';
        opt.textContent = 'Sin tallas disponibles';
        tallaSelect.appendChild(opt);
        return;
    }

    variantes.forEach(v => {
        const opt = document.createElement('option');
        opt.value = v.IdProducto;
        opt.dataset.stock = v.Stock ?? 0;
        opt.textContent = `${v.NomTalla ?? 'Talla'} (Stock: ${v.Stock ?? 0})`;
        tallaSelect.appendChild(opt);
    });

}

function renderCart() {
    const tbody = document.getElementById('cartBody');
    tbody.innerHTML = '';
    const ids = Object.keys(cartState);
    if (ids.length === 0) {
        tbody.innerHTML = '<tr><td colspan="6" class="text-muted">No hay items</td></tr>';
        document.getElementById('cartTotal').innerText = '$0';
        return;
    }
    let total = 0;
    ids.forEach(id => {
        const it = cartState[id];
        total += Number(it.Subtotal);
        const tr = document.createElement('tr');
        tr.innerHTML = `<td>${it.Nombre}</td>
                        <td>${it.NomTalla || '-'}</td>
                        <td>$${Number(it.PrecioUnitario).toLocaleString()}</td>
                        <td>${it.Cantidad}</td>
                        <td>$${Number(it.Subtotal).toLocaleString()}</td>
                        <td><button class="btn btn-sm btn-danger" onclick="removeItem(${id})">Eliminar</button></td>`;
        tbody.appendChild(tr);
    });
    document.getElementById('cartTotal').innerText = '$' + total.toLocaleString();
}

document.getElementById('btnAdd').addEventListener('click', async () => {
    const IdProducto = tallaSelect.value;
    const Cantidad = Number(document.getElementById('Cantidad').value || 0);
    const selectedTalla = tallaSelect.selectedOptions[0];
    const stock = Number(selectedTalla ? (selectedTalla.dataset.stock || 0) : 0);

    if (!IdProducto) {
        alert('Selecciona una talla');
        return;
    }
    if (Cantidad <= 0) {
        alert('Cantidad invalida');
        return;
    }
    if (Cantidad > stock) {
        alert('La cantidad supera el stock de la talla seleccionada');
        return;
    }

    const res = await fetch('index.php?action=addToCart', {
        method: 'POST',
        headers: {'Accept': 'application/json', 'Content-Type': 'application/x-www-form-urlencoded'},
        body: new URLSearchParams({IdProducto, Cantidad})
    });
    const json = await res.json();
    if (!json.ok) { alert(json.msg || 'Error'); return; }
    cartState = json.cart;
    renderCart();
});

async function removeItem(id) {
    const res = await fetch('index.php?action=removeFromCart', {
        method: 'POST',
        headers: {'Accept': 'application/json', 'Content-Type': 'application/x-www-form-urlencoded'},
        body: new URLSearchParams({IdProducto: id})
    });
    const json = await res.json();
    cartState = json.cart;
    renderCart();
}

document.getElementById('btnSave').addEventListener('click', async () => {
    const NumDoc = document.getElementById('NumDoc').value;
    if (!NumDoc) { alert('Selecciona un cliente'); return; }
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = 'index.php?action=saveFactura';
    form.target = '_blank';
    const input = document.createElement('input');
    input.name = 'NumDoc';
    input.value = NumDoc;
    form.appendChild(input);
    document.body.appendChild(form);
    form.submit();
});

productoSearch.addEventListener('input', () => filtrarSelect(productoBase, productoSearch.value, false));
clienteSearch.addEventListener('input', () => filtrarSelect(clienteSelect, clienteSearch.value, true));
productoBase.addEventListener('change', renderTallas);

renderTallas();
</script>

</body>
</html>
