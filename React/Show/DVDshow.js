const DVDshow = ({SKU, name, price, size,type, handleCheckbox}) => {
    return ( 
        <div className="DVDshow">
            <input className="delete-checkbox" type="checkbox" onChange={e=> handleCheckbox(SKU,type, e.target.checked)}/>
            {SKU}<br></br>
            {name}<br></br>
            {price} $<br></br>
            SIZE: {size}
        </div>
     );
}
 
export default DVDshow;