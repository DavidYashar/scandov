
const Furniture = ({height, setHeight, width, setWidth, length, setLength}) => {
  

    return ( 
       
           <div id='Furniture' className="furniture delete-checkbox">
            <label htmlFor='height'>height(CM)
              <input name="height" type="number" id="height" min={20} max={180}
              value={height} onChange={(event)=> setHeight(event.target.value)} placeholder="enter the height" />
            </label>

            <label htmlFor='width'>width(CM)
              <input name="width"  type="number" id="width" min={20} max={180}
              value={width} onChange={(event)=> setWidth(event.target.value)}   placeholder="enter the width"/>
              </label>


            <label htmlFor='length'>length(CM)
              <input name="length" type="number"  id="length" min={20} max={180}
              value={length} onChange={(event)=> setLength(event.target.value)}   placeholder="enter the length"/>
              </label>
              </div>
      
     );
}
 
export default Furniture;