import axios from "axios";
import { useState } from "react";

const AddProduct = () => {
    const [sku, setSku] = useState("");
    const [nome, setNome] = useState("");
    const [value, setValue] = useState("");
    const [peso, setPeso] = useState("");
    const [tamanho, setTamanho] = useState("");
    const [altura, setAltura] = useState("");
    const [largura, setLargura] = useState("");
    const [comprimento, setComprimento] = useState("");
    const [productType, setProductType] = useState("0");
    const endPoint = 'https://juniorweb-test-main-production.up.railway.app/scandiweb/';
    
    async function addProduct() {
        const product = {
            sku, nome, "valor":value, "tipo": productType
        }
        switch (productType) {
            case "livros":
                product["peso"] = peso
                break;
            case "dvds":
                product["tamanho"] = tamanho
                break;
            case "furniture":
                product["altura"] = altura
                product["largura"] = largura
                product["comprimento"] = comprimento
                break;

            default:
                break;
        }
        axios.post(endPoint + "juniorTestGustavoAlda/produtos/cadastrar",product).then(
            ()=>{
                window.location.href="/"
            }
        )
    }
    return (
        <div>
            <div id="id-header" class="container">
                <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
                    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
                        <svg class="bi me-2" width="40" height="32"></svg>
                        <span class="fs-4"><h1>Product Add</h1></span>
                    </a>

                    <ul class="nav nav-pills">
                        <li class="nav-item m-2">
                            <button class="nav-link active" aria-current="page" onClick={() => {
                                addProduct()
                            }}>Save</button>
                        </li>
                        <a href="/">
                            <button id="delete-product.btn" class="btn btn-secondary m-2" type="button" aria-expanded="false">
                                Cancel
                            </button>
                        </a>
                    </ul>
                </header>
            </div>

            <div class="container mt-5">
                <form id="product_form" class="" action="add.php" method="POST">
                    <div class="form-group mb-2">
                        <label id="sku" class="mb-1">SKU</label>
                        <input type="text"
                            class="form-control"
                            placeholder="Product SKU"
                            name="psku"
                            onChange={e => setSku(e.target.value)} value={sku} />
                    </div>

                    <div class="form-group mb-2">
                        <label id="name" class="mb-1">Name</label>
                        <input type="text"
                            class="form-control"
                            placeholder="Product Name"
                            name="pname"
                            onChange={e => setNome(e.target.value)} value={nome} />
                    </div>

                    <div class="form-group mb-2">
                        <label id="price" class="mb-1">Price ($)</label>
                        <input type="number"
                            class="form-control"
                            placeholder="Product Price"
                            name="pprice"
                            onChange={e => setValue(e.target.value)} value={value} />
                    </div>
                    <div class="form-group mb-2">
                        <label id="productType" class="mb-1">Type Switcher</label>
                        <select onChange={e => setProductType(e.target.value)} value={productType} id="productType" class="form-control"
                            name="Type Switcher">
                            <option value="0">
                                Select Type
                            </option>
                            <option id="DVD" value="dvds">
                                DVD
                            </option>
                            <option id="Book" value="livros">
                                Book
                            </option>
                            <option id="Furniture" value="furniture">
                                Furniture
                            </option>
                        </select>
                    </div>
                    <div class="mt-2" >
                        {productType === "dvds" ? (<div>
                            <div class="form-group mb-2 ">
                                <label id="size" class="mb-1">Size (MB)</label>
                                <input type="text"
                                    class="form-control"
                                    placeholder="Please provide size in MegaBytes (MB)"
                                    onChange={e => setTamanho(e.target.value)} value={tamanho} />
                            </div>
                        </div>) : productType === "livros" ? (<div>
                            <div class="form-group mb-2">
                                <label id="weight" class="mb-1">Weight (KG)</label>
                                <input type="text"
                                    class="form-control"
                                    placeholder="Please provide weight in KiloGrams (KG)"
                                    onChange={e => setPeso(e.target.value)} value={peso} />
                            </div>
                        </div>) : productType === "furniture" ? (<div>
                            <div class="form-group mb-2">
                                <label id="height" class="mb-1">Height (CM)</label>
                                <input type="text"
                                    class="form-control"
                                    placeholder="Please provide height in centimeters(CM)"
                                    onChange={e => setAltura(e.target.value)} value={altura} />
                            </div>
                            <div class="form-group mb-2">
                                <label id="width" class="mb-1">Width (CM)</label>
                                <input type="text"
                                    class="form-control"
                                    placeholder="Please provide width in centimeters (CM)"
                                    onChange={e => setLargura(e.target.value)} value={largura} />
                            </div>
                            <div class="form-group mb-2">
                                <label id="lenght" class="mb-1">Lenght (CM)</label>
                                <input type="text"
                                    class="form-control"
                                    placeholder="Please provide lenght in centimeters (CM)"
                                    onChange={e => setComprimento(e.target.value)} value={comprimento} />
                            </div>
                        </div>) : (<div></div>)}
                    </div>
                </form>
            </div>


            <div id="id-footer" class="container">
                <footer class="py-3 my-4">
                    <ul class="nav justify-content-center border-bottom pb-3 mb-3">
                    </ul>
                    <p class="text-center text-muted">Scandiweb Test assingment - made by Gustavo Alda / alda510</p>
                </footer>
            </div>
        </div>
    )
}
export default AddProduct;