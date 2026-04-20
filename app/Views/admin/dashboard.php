<h2>Dashboard</h2>
<div class="row mt-4">
    <div class="col-md-3">
        <div class="card text-bg-primary mb-3">
            <div class="card-body">
                <h5 class="card-title">Toplam Lisans</h5>
                <p class="card-text fs-2"><?= $total ?? 0 ?></p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-bg-success mb-3">
            <div class="card-body">
                <h5 class="card-title">Aktif Lisans</h5>
                <p class="card-text fs-2"><?= $active ?? 0 ?></p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-bg-danger mb-3">
            <div class="card-body">
                <h5 class="card-title">Süresi Dolan</h5>
                <p class="card-text fs-2"><?= $expired ?? 0 ?></p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-bg-warning mb-3">
            <div class="card-body">
                <h5 class="card-title">Askıya Alınan</h5>
                <p class="card-text fs-2"><?= $suspended ?? 0 ?></p>
            </div>
        </div>
    </div>
</div>
