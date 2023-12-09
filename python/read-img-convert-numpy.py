from PIL import Image
import numpy as np
img = Image.open("map.bmp")
img_np = np.array(img)
print(img_np.shape)
print(img_np.ndim)


