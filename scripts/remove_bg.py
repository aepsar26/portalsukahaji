import sys
from rembg import remove
from PIL import Image

# Baca file input & output dari argumen
input_path = sys.argv[1]
output_path = sys.argv[2]

with Image.open(input_path) as img:
    output = remove(img)
    output.save(output_path)
