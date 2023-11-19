import {useState, useEffect} from 'react';
import axios from 'axios';
import {Link} from 'react-router-dom';
import '../CSS/ProductList.css';
import BooksShow from '../Show/BooksShow';
import FurnitureShow from '../Show/FurnitureShow';
import DVDshow from '../Show/DVDshow';


const ProductList = () => {

const [products, setProducts] = useState([]);
const [deleted, setDeleted] = useState([]);
const [refreshed, setRefreshed] = useState(false)
const [result, setResult] = useState('');


 useEffect(()=> {
    const fetchData = async ()=> {
        try{
            const res = await axios.post('http://scandnov.000.pe/PHP/index.php')
            console.log(res.data)
            setProducts(res.data)
        }catch(error){
            console.error(error)
        }
    };
    fetchData()
 }, [refreshed])

 useEffect(() => {
    // This effect will refetch data when refreshed state changes
    const fetchData = async () => {
      try {
        const res = await axios.post('http://scandnov.000.pe/PHP/index.php');
        setProducts(res.data);
      } catch (error) {
        console.error(error);
      }
    };
    fetchData();
  }, [refreshed]);

 //handling deleteting of the products
 const handleCheckbox = (sku, type, isChecked)=> {
    if(isChecked){
        setDeleted(prev=> [...prev, {sku, type}])
    }else{
        setDeleted(prev => prev.filter(prevSKU => prevSKU !==sku))
    }
    console.log(deleted)
 }
const handleDelete = async() => {
try {
    console.log(deleted)
  const res=  await axios.post('http://scandnov.000.pe/PHP/delete.php', {skus: deleted})
    setRefreshed(prev => !prev)
    console.log(res.data)
    if(res.data.includes('succcessfully')){
        setResult(res.data)
    }
} catch (error) {
    console.error(error)
}
}
 return (
    <>

<div className="buttons">
<button id='delete-product-btn' onClick={handleDelete}>MASS DELETE</button>
    <button ><Link to={'/ProductAdd'}>ADD</Link></button>
    <h6>{result}</h6>
</div>





    <div className="data">
        {products &&
products.filter((item)=>item.type === 'Book').map(item=>(
           
         
            <BooksShow 
            handleCheckbox={handleCheckbox}
            key={item.sku}
            SKU ={item.sku}
            name = {item.name}
            type={item.type}
            price = {item.price}
            weight = {item.weight}
/>

 ))} 
       
       

{products && products.filter((item)=>item.type === 'Furniture').map(item=>(
  
            <FurnitureShow 
            handleCheckbox={handleCheckbox}
            key={item.sku}
            SKU ={item.sku}
            name = {item.name}
            price = {item.price}
            type={item.type}
            height={item.height}
            length={item.length}
            width={item.width}
/> 

))}




{products && products.filter((item)=>item.type === 'DVD').map(item=>(
    
            <DVDshow
            handleCheckbox={handleCheckbox}
            key={item.sku}
            SKU ={item.sku}
            name = {item.name}
            type={item.type}
            price = {item.price}
            size={item.size}
/> 

))}


   
    </div>

    </>
    
 )
}
export default ProductList;