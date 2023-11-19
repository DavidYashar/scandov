const FurnitureShow = ({SKU, name, price ,type, height, length, width, handleCheckbox}) => {
    return ( 
        <div className="FurnitureShow">
            <input className="delete-checkbox" type="checkbox" onChange={e=> handleCheckbox(SKU,type, e.target.checked)}/>
            {SKU}<br></br>
            {name}<br></br>
            {price} $<br></br>
         Dimension: {height} X {length} X {width} 
        </div>
     );
}
 
export default FurnitureShow;