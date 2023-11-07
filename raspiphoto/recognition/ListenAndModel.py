import os
import time
import shutil
from tensorflow.keras.models import load_model
from PIL import Image, ImageOps
import numpy as np

# 要監聽的資料夾路徑
# folder_path = '/home/chien/Downloads'
folder_path = '/home/beta/fridgeweb/raspiphoto/new'

# 放拿去辨識的複製品圖片的資料夾路徑
# copyfolder_path = '/home/chien/Desktop/converted_keras/copy'
copyfolder_path = '/home/beta/fridgeweb/raspiphoto/copy'

# 最後結果的資料夾路徑
finalfolder_path = '/home/beta/fridgeweb/raspiphoto/final'

# 監聽間隔時間（秒）
interval = 1

# 載入模型
model = load_model("/home/beta/fridgeweb/raspiphoto/recognition/keras_model.h5", compile=False)

# 載入標籤
class_names = open("/home/beta/fridgeweb/raspiphoto/recognition/labels.txt", "r").readlines()

# 儲存上次檢測到的檔案列表
last_files = []

print("============================")
print("*** Start ListenModel.py ***")
print("============================")

while True:
    # 取得目前資料夾內的所有檔案
    files = os.listdir(folder_path)
    
    # 檢查是否有新增的圖片檔案
    new_files = [f for f in files if f not in last_files and f.lower().endswith(('.jpg', '.jpeg', '.png'))]
    
    # 執行圖片辨識並傳送新增圖片的路徑給圖片辨識程式
    for file in new_files:
        print("ListenModel: New photo from Rpi\n")
        
        file_path = os.path.join(folder_path, file)
        # 複製原始照片到copy資料夾
        shutil.copy(file_path, copyfolder_path)
        copyfile_path = os.path.join(copyfolder_path, file)
        
        print("ListenModel: Start check photo")
        
        # 圖片辨識部分
        image = Image.open(copyfile_path).convert("RGB")
        size = (224, 224)
        image = ImageOps.fit(image, size, Image.Resampling.LANCZOS)
        image_array = np.asarray(image)
        normalized_image_array = (image_array.astype(np.float32) / 127.5) - 1
        data = np.ndarray(shape=(1, 224, 224, 3), dtype=np.float32)
        data[0] = normalized_image_array
        
        # 辨識結果
        prediction = model.predict(data)
        index = np.argmax(prediction)
        class_name = class_names[index].strip()
        confidence_score = prediction[0][index]
        
        # 輸出辨識結果和信心分數
        class_name = class_name.split(' ', 1)[1]
        print("Image:", copyfile_path)
        print("Class:", class_name)
        print("Confidence Score:", confidence_score)
        
        if confidence_score < 0.3:
            class_name = "X"
        
        # 取得原始檔名
        output_filename = os.path.basename(file_path)
        # 新的檔名
        output_filename = f"{os.path.splitext(output_filename)[0]}_{class_name}.jpg"
        # 移動監聽的資料夾中的新圖片至最終結果資料夾並重新命名
        shutil.move(file_path, os.path.join(finalfolder_path, output_filename))
         # 刪除copy資料夾中的新圖片
        os.remove(copyfile_path)
        
    # 更新上次檢測到的檔案列表
    last_files = files
    
    # 等待一段時間後再進行下一次檢測
    time.sleep(interval)


