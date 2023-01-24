import './App.css';
import { BrowserRouter, Routes, Route } from "react-router-dom";
import ProductList from './pages/ProductList';
import AddProduct from './pages/AddProduct';



function App() {
  return (
    <BrowserRouter>
      <Routes>
        <Route path="/">
          <Route index element={<ProductList/>} />
          <Route path ="addProduct" element={<AddProduct/>} />
        </Route>
      </Routes>
    </BrowserRouter>
  );
}

export default App;