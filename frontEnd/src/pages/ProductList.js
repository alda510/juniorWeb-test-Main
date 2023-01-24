import Item from "../Item";
import axios from "axios";
import { useEffect, useState } from "react";

const ProductList = () => {
  const [list, setList] = useState([]);
  let skuList = [];
  const addToList = (sku) => {
    if (skuList.includes(sku)) {
      skuList = skuList.filter(item => item !== sku
      );
    }
    else {
      skuList.push(sku)
    }
    console.log(skuList)
  }

  const endPoint = 'https://juniorweb-test-main-production.up.railway.app/scandiweb/';

  async function massDelete(list) {
    const formatedList = {
      "parametros": list.map((item) => {
        return {
          "sku": item
        }
      })
    }
    try {
      await axios.delete(endPoint + "juniorTestGustavoAlda/produtos/deletar", { headers: {}, data: formatedList });
      getData()
    } catch (error) { console.log(error) }
  }
  async function getData() {
    setList(
      (await axios.get(endPoint + "juniorTestGustavoAlda/produtos",
        {
          headers: {
            "Access-Control-Allow-Origin": 'https://juniorweb-test-main-production.up.railway.app/',
          }
        }))
        .data.content.content)
  }
  useEffect(() => {
    getData()
  }, []);

  return (
    <div>
      <div id="id-header" class="container">
        <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
          <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
            <span><h1>Product List</h1></span>
          </a>
          <ul class="nav nav-pills">
            <li class="nav-item m-2">
              <a href="/addProduct" class="nav-link active" aria-current="page">Add</a>
            </li>
            <button id="delete-product.btn" class="btn btn-secondary m-2" onClick={() => massDelete(skuList)} type="button" aria-expanded="false">
              Mass Delete
            </button>
          </ul>
        </header>
      </div>

      <div id="id-maincard" class="container d-flex w-100 flex-wrap justify-content-start">
        {list.map(item => { return (<Item getSku={addToList} props={item}></Item>) })}
      </div>

      <div id="id-footer" class="container">
        <footer class="py-3 my-4">
          <ul class="nav justify-content-center border-bottom pb-3 mb-3">
          </ul>
          <p class="text-center text-muted">Scandiweb Test assingment - made by Gustavo Alda / alda510</p>
        </footer>
      </div>
      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
      <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
    </div>
  );
}
export default ProductList;