
const Books = ({weight, setWeight}) => {

    return ( 
          
            <div id='Book' className="book delete-checkbox">
            <label htmlFor='weight'>weight(KG)
               <input type="number" name="weight" id="weight" min={1} max={20}
               value={weight} onChange={(event)=> setWeight(event.target.value)} placeholder="please enter the weight"/>
            </label>
            </div>
         
     
     );
}
 
export default Books;