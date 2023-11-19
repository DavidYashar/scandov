
const DVD = ({size, setSize, }) => {
    
    return ( 
       
            <div id='DVD' className="dvd delete-checkbox">
              
            <label htmlFor='size'>size(MB)
              <input id="size" type="number" name="size" min={20} max={2000}
              value={size} onChange={(event)=> setSize(event.target.value)}  placeholder="enter the size"/>
              </label>
              </div>
            
       
     );
}
 
export default DVD;