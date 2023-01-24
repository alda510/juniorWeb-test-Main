const Item = ({ props, getSku }) => {
    return (
        <div class="w-25 p-3">
            <div class="border d-flex p-3">
                <div class="">
                    <input type="checkbox" class=".delete-checkbox" onClick={() => getSku(props.sku)}></input>
                </div>
                <div class="d-flex justify-content-center flex-fill">
                    <div class="text-center">
                        {props.sku}
                        <br></br>
                        {props.nome}
                        <br></br>
                        {props.valor + " $"}
                        <br></br>
                        {props.tipo === "livros" ? props.properties.peso + " Kg" :
                            props.tipo === "dvds" ? props.properties.tamanho + " MB" :
                            props.properties.dimensions + " cm"}
                    </div>
                </div>
            </div>
        </div>
    )
}
export default Item