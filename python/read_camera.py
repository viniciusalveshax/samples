# Código baseado em https://www.geeksforgeeks.org/python-opencv-capture-video-from-camera/

# import the opencv library
import cv2
  
print("Tentando começar a captura")
  
print(cv2.getBuildInformation())  

  
# define a video capture object
vid = cv2.VideoCapture(1)

if not vid.isOpened():
    raise IOError("Cannot open webcam")
  
print("Começou a captura")  
  
while(True):
      
    # Capture the video frame
    # by frame
    ret, frame = vid.read()
  
    # Display the resulting frame
    cv2.imshow('frame', frame)
      
    # the 'q' button is set as the
    # quitting button you may use any
    # desired button of your choice
    if cv2.waitKey(1) & 0xFF == ord('q'):
        break
  
# After the loop release the cap object
vid.release()
# Destroy all the windows
cv2.destroyAllWindows()
