// Modificado a partir de https://hossein-zare.github.io/react-native-dropdown-picker-website/docs/usage

import React, {useState} from 'react';
import DropDownPicker from 'react-native-dropdown-picker';

const Seletor = () => {

  const [open, setOpen] = useState(false);
  const [value, setValue] = useState(null);
  const [items, setItems] = useState([
    {label: 'Apple', value: 'apple'},
    {label: 'Banana', value: 'banana'}
  ]);

  return (
    <DropDownPicker
      open={open}
      value={value}
      items={items}
      setOpen={setOpen}
      setValue={setValue}
      setItems={setItems}
	onChangeValue={(value) => {
	  console.log(value);
	}}
    />
  );
}

export default Seletor;
