self.addEventListener('message', messageReceived);

function messageReceived(e) {

var [buffer] = e.data;

var uInt8Arr = new Uint8Array(buffer); // 16MB

for (var i = 0; i < uInt8Arr.length; ++i) {
    uInt8Arr[i] = i*2;
}

// return the regions back to the main thread
postMessage([buffer], [buffer]);
}


