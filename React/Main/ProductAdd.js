import { useState} from 'react';
import axios from 'axios';

import DVD from './DVD';
import Furniture from './Furniture';
import Books from './Books';
import {Link} from 'react-router-dom';

import '../CSS/ProductAdd.css';
const ProductAdd = () => {

  const [SKU, setSKU] = useState('');
  const [names, setNames] = useState('');
  const [price, setPrice] = useState(0);
  const [type, setType] = useState('');

  //Furniture valirable:
  const [height, setHeight] = useState('');
  const [width, setWidth] = useState('');
  const [length, setLength] = useState('');

  //DVD variable:
  const [size, setSize] = useState('');

  //Book Variable:
  const [weight, setWeight] = useState('');

  //result
  const[result, setResult] = useState('');
 



    const nameReg =  /^[A-Za-z0-9]+$/;
    const SKUreg = /^[A-Za-z0-9]+$/;
  

  const handleSubmit = async (e)=>{

    if (!SKU || SKU.length >15 || SKU.length <4  ) {
      setResult('please enter the SKU, must be shorter than 15 chars')
    } else if(!SKUreg.test(SKU)) {
      setResult('Please use number and characters only for SKU')
    }
     else if (!names || !nameReg.test(names) ) {
      setResult('Please enter the name and use only proper words and numbers')
    } else if (!price) {
      setResult('Please enter the price')
    } else if (!type) {
      setResult('please select one of the products')
    } else {
 
    e.preventDefault()

    const formData = {
      SKU: SKU,
      names: names,
      price: price,
      type: type,
      height: height,
      width: width,
      length: length,
      size: size,
      weight: weight
   }
  

    try{
      const post =await axios.post('http://scandnov.000.pe/PHP/insert.php',formData, {
      
      headers: {
       'ContentType': 'Application/json',
     
    },
    });
    
    console.log(post.data)
    setResult(post.data)

    if (post.data.includes('successfully')) {
      setTimeout(() => {
        window.location.href = '/'
      }, 1000);
    }
    } catch (error) {
      console.error('Error posting data', error)
    }
  }
}

    return ( 
        <>

<div className="product-form" id='product_form'>

<label htmlFor="sku">SKU:</label><br />
<input type="text" id='sku' value={SKU}
 onChange={e=>setSKU(e.target.value)}
 placeholder=' only words and numbers between 4-15 chars'
 required/><br/>


<label htmlFor="name">Name:</label><br />
<input type="text" id='name' value={names} onChange={e=> setNames(e.target.value)}
placeholder='name should be only words and numbers'
required/><br/>

<label htmlFor="price">Price:</label><br />
<input type="number" id='price' value={price} min='5' onChange={e=> setPrice(e.target.value)}
placeholder='price should be minimum 5$'
required/><br/><br />


<select name="type" id="productType" onChange={e=> setType(e.target.value)}>
  <option value="">select one</option>
  <option value="Book">Book</option>
  <option value="Furniture">furniture</option>
  <option value="DVD">DVD</option>
</select><br /><br />


{type === 'Book' && <Books
 weight={weight} setWeight={setWeight}

 />}
{type === 'DVD' && <DVD
 size={size} setSize={setSize}


 />}
{type === 'Furniture' && <Furniture

height={height} setHeight={setHeight} width={width}
 setWidth={setWidth} length={length} setLength={setLength}

 />}

<button id='Save' onClick={handleSubmit}>Save</button>
<button id='Cancel'><Link to={'/'}> Cancel</Link></button>
</div>

<h5>{result}</h5>
        </>
     );
}
 
export default ProductAdd;
