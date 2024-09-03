
<div class="d-flex square line">
    <div class="line-item">
        <label for="length">Dài</label>
        <input id="length" type="number"/>
    </div>
    <div class="line-item">
        <label for="width">Rộng</label>
        <input id="width" type="number"/>
    </div>
    <div class="line-item">
        <label for="square">Diện tích</label>
        <input id="square" type="number" disabled/>
    </div>
</div>
<style>
    .line {
        width: 100%;
        justify-content: space-between;
    }
    .square .line-item {
        width: 30%;
    }
    .line-item input {
        width: 100%;
    }
</style>

