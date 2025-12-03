<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Crear Factura</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/tables.css">
    <style>
        .small-input { width:120px; display:inline-block; }
        .cart-table img { max-width:70px; border-radius:8px; }
    </style>
    </head>
    <body>
    <div class="wrapper-box">
    <h2>Crear Factura</h2>

    <?php if (!empty($_SESSION['error'])): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($_SESSION['error']); unset($_SESSION['error']); ?></div>
    <?php endif; ?>

    <form id="addForm">
        <div class="row g-2 align-items-end">
        <div class="col-md-5">
            <label>Producto</label>
            <select id="IdProducto" class="form-select">
            <?php foreach ($productos as $p): ?>
                <option value="<?= $p['IdProducto'] ?>"><?= htmlspecialchars($p['Nombre']) ?> — $<?= number_format($p['Precio'],0,',','.') ?> — Stock: <?= $p['Stock'] ?></option>
            <?php endforeach; ?>
            </select>
        </div>

        <div class="col-md-2">
            <label>Cantidad</label>
            <input type="number" id="Cantidad" class="form-control" value="1" min="1">
        </div>

        <div class="col-md-3">
            <label>Cliente</label>
            <select id="NumDoc" class="form-select">
            <option value="">-- Selecciona cliente --</option>
            <?php foreach ($clientes as $c): ?>
                <option value="<?= $c['NumDoc'] ?>"><?= htmlspecialchars($c['NombreCom']) ?> (<?= $c['NumDoc'] ?>)</option>
            <?php endforeach; ?>
            </select>
        </div>

        <div class="col-md-2">
            <button type="button" id="btnAdd" class="btn btn-primary w-100">Agregar</button>
        </div>
        </div>
    </form>

    <hr>

    <h4>Carrito</h4>
    <div class="table-responsive">
        <table class="table cart-table">
        <thead>
            <tr><th>Producto</th><th>Precio</th><th>Cant.</th><th>Subtotal</th><th></th></tr>
        </thead>
        <tbody id="cartBody">
            <tr><td colspan="5" class="text-muted">No hay items</td></tr>
        </tbody>
        <tfoot>
            <tr>
            <td colspan="3" class="text-end"><strong>Total</strong></td>
            <td id="cartTotal">$0</td>
            <td></td>
            </tr>
        </tfoot>
        </table>
    </div>

    <div class="d-flex gap-2">
        <button id="btnSave" class="btn btn-success">Guardar Factura</button>
        <a href="index.php?action=listFactura" class="btn btn-secondary">Volver</a>
    </div>
    </div>

    <script>
    async function fetchJson(url, data) {
    const resp = await fetch(url, { method: 'POST', headers:{'Accept':'application/json','Content-Type':'application/x-www-form-urlencoded'}, body: new URLSearchParams(data) });
    return resp.json();
    }

    async function refreshCart() {
    // We'll ask a tiny endpoint to return cart content; but simpler: re-render from server response stored in session via add/remove responses.
    // For simplicity call an endpoint that returns cart (we use addToCart and removeFromCart responses)
    // We'll rely on add/remove to return current cart; to initialize, call a small endpoint: index.php?action=getCart (we don't have it). Instead, just request the server: addToCart with no-op will fail.
    // Simpler: keep a client side mirror by using responses from add/remove. We'll maintain cartState global.
    }

    let cartState = {};

    function renderCart() {
    const tbody = document.getElementById('cartBody');
    tbody.innerHTML = '';
    const ids = Object.keys(cartState);
    if (ids.length === 0) {
        tbody.innerHTML = '<tr><td colspan="5" class="text-muted">No hay items</td></tr>';
        document.getElementById('cartTotal').innerText = '$0';
        return;
    }
    let total = 0;
    ids.forEach(id => {
        const it = cartState[id];
        total += Number(it.Subtotal);
        const tr = document.createElement('tr');
        tr.innerHTML = `<td>${it.Nombre}</td>
                        <td>$${Number(it.PrecioUnitario).toLocaleString()}</td>
                        <td>${it.Cantidad}</td>
                        <td>$${Number(it.Subtotal).toLocaleString()}</td>
                        <td><button class="btn btn-sm btn-danger" onclick="removeItem(${id})">Eliminar</button></td>`;
        tbody.appendChild(tr);
    });
    document.getElementById('cartTotal').innerText = '$' + total.toLocaleString();
    }

    document.getElementById('btnAdd').addEventListener('click', async () => {
    const IdProducto = document.getElementById('IdProducto').value;
    const Cantidad = document.getElementById('Cantidad').value;
    const res = await fetch('index.php?action=addToCart', { method:'POST', headers:{'Accept':'application/json','Content-Type':'application/x-www-form-urlencoded'}, body: new URLSearchParams({IdProducto, Cantidad})});
    const json = await res.json();
    if (!json.ok) { alert(json.msg || 'Error'); return; }
    cartState = json.cart;
    renderCart();
    });

    async function removeItem(id) {
    const res = await fetch('index.php?action=removeFromCart', { method:'POST', headers:{'Accept':'application/json','Content-Type':'application/x-www-form-urlencoded'}, body: new URLSearchParams({IdProducto: id})});
    const json = await res.json();
    cartState = json.cart;
    renderCart();
    }

    document.getElementById('btnSave').addEventListener('click', async () => {
    const NumDoc = document.getElementById('NumDoc').value;
    if (!NumDoc) { alert('Selecciona un cliente'); return; }
    // submit form to controller
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = 'index.php?action=saveFactura';
    const input = document.createElement('input'); input.name = 'NumDoc'; input.value = NumDoc; form.appendChild(input);
    document.body.appendChild(form);
    form.submit();
    });
    </script>

    </body>
    </html>
