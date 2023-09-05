import { StatusBar } from 'expo-status-bar';
import { StyleSheet, Text, View, Button } from 'react-native';

// Exemplo 2
import AssetExample from './components/AssetExample';

// Exemplo 3
import Seletor from './components/Seletor';

/* Exemplo 4 modificado a partir de https://reactnative.dev/docs/navigation */
import {NavigationContainer} from '@react-navigation/native';
import {createNativeStackNavigator} from '@react-navigation/native-stack';

const HomeScreen = ({navigation}) => {
  return (
    <Button
      title="Go to Jane's profile"
      onPress={() =>
        navigation.navigate('Profile', {name: 'Jane'})
      }
    />
  );
};
const ProfileScreen = ({navigation, route}) => {
  return <Text>This is {route.params.name}'s profile</Text>;
};

const Stack = createNativeStackNavigator();
//Fim das importações do exemplo 4

export default function App() {
  return (
//Exemplo 1
	<View style={styles.container}>
		<Text>Open up App.js to start working on your app!!!</Text>
		<StatusBar style="auto" />
	</View>
//Fim do exemplo 1

//Exemplo 2
/*
	<View style={styles.container}>

		<Seletor />
	
		<AssetExample />

	</View>
*/
//Fim do exemplo 2

//Exemplo 3
/*
	<View style={styles.container}>

		<Seletor />
	
		<AssetExample />

	</View>
*/
//Fim do exemplo 3

// Exemplo 4
/*
    <NavigationContainer>
      <Stack.Navigator>
        <Stack.Screen
          name="Home"
          component={HomeScreen}
          options={{title: 'Welcome'}}
        />
        <Stack.Screen name="Profile" component={ProfileScreen} />
      </Stack.Navigator>
    </NavigationContainer>		
*/
// Fim do exemplo 4

  );
}

const styles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: '#fff',
    alignItems: 'center',
    justifyContent: 'center',
  },
});
