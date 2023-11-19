const BooksShow = ({SKU, name, price, weight,type, handleCheckbox}) => {
    return ( 
        <div className="BooksShow">
            <input className="delete-checkbox" type="checkbox" onChange={e=> handleCheckbox(SKU,type, e.target.checked)}/>
             {SKU}<br></br>
            {name}<br></br>
            {price} $<br></br>
        WEIGHT: {weight}
        </div>
     );
}
 
export default BooksShow;
