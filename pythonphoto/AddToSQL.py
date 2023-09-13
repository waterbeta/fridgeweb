import os
import json
from datetime import datetime, timedelta
import time

# pip install mysql-connector-python
import mysql.connector
# MySQL 連接配置
config = {
    'user': 'sail',
    'password': 'password',  # Sail MySQL 密碼
    'host': '127.0.0.1',    # Sail MySQL 主機
    'database': 'fridgeweb',  # 數據庫名稱
    'port': '3306'          # MySQL 端口
}

# 連接到 MySQL 數據庫
connection = mysql.connector.connect(**config)
cursor = connection.cursor()

# 監聽的資料夾路徑
folder_path = '../newphoto'  # 根據您的實際路徑更改

while True:
    # 獲取資料夾中的所有檔案
    files = os.listdir(folder_path)
    print("Start round.")
    
    if files:
        # 找到最早修改的檔案
        files.sort(key=lambda x: os.path.getmtime(os.path.join(folder_path, x)))
        file_name = files[0]
        file_path = os.path.join(folder_path, file_name)

        # 輸出偵錯訊息：獲取照片名稱
        print(f'Get photo "{file_name}"')

        # 解析檔案名稱
        file_name_parts = file_name.split('_')
        if len(file_name_parts) == 5:
            put_time = file_name_parts[0] + '_' + file_name_parts[1]
            fridge_id = int(file_name_parts[2])
            in_out = 1 if file_name_parts[3] == 'in' else 0
            kind = file_name_parts[4].split('.')[0]  # 移除文件擴展名
            
            if in_out == 1:
                # 讀取 JSON 文件以獲取持續時間（以天為單位）
                try:
                    with open('alarm_time.json', 'r') as json_file:
                        alarm_data = json.load(json_file)
                        duration_days = int(alarm_data.get(kind, -1))  # 將 '7' 解釋為整數 7
                        if duration_days == -1:
                            print(f'!Error! Without expiry date data in json: "{kind}"')
                            duration_days = 7
                except FileNotFoundError:
                    print('!Error! No exist alarm_time.json.')
                    duration_days = 7

                # 計算 alarm_time
                put_time_datetime = datetime.strptime(put_time, '%Y%m%d_%H%M%S')
                alarm_time_datetime = put_time_datetime + timedelta(days=duration_days)
                alarm_time = alarm_time_datetime.strftime('%Y%m%d_%H%M%S')
            
                try:
                    with open('name_table.json', 'r') as name_file:
                        name_data = json.load(name_file)
                        CTname = name_data.get(kind, '--')
                        if CTname == '--':
                            print(f'!Error! Without name data in json: "{kind}"')
                            CTname = kind
                except FileNotFoundError:
                    print('!Error! No exist nameTable.json.')
            
                num = 1
            
                # 輸出完整的 INSERT 語句
                print(f'INSERT INTO product (name, kind, num, put_time, alarm_time, photo_name, exist, fridge_id) \n'
                      f'VALUES ("{CTname}", "{kind}", {num}, "{put_time}", "{alarm_time}", "{file_name}", {in_out}, {fridge_id})')

                # 插入數據到 MySQL
                insert_query = """
                INSERT INTO product (name, kind, num, put_time, alarm_time, photo_name, exist, fridge_id)
                VALUES (%s, %s, %s, %s, %s, %s, %s, %s)
                """
                data_to_insert = (CTname, kind, num, put_time, alarm_time, file_name, in_out, fridge_id)

                cursor.execute(insert_query, data_to_insert)
                connection.commit()
            
            else: # out case
                query = f"""
                UPDATE product
                SET exist = 0
                WHERE kind = "{kind}" AND exist = 1
                ORDER BY put_time ASC
                LIMIT 1
                """
                cursor.execute(query)
                connection.commit()
                print(f'Updated product with name "{CTname}", kind "{kind}" in fridge {fridge_id} to Not Exist.')

            # 移動照片到另一個資料夾
            dest_folder = '../photos'  # 根據您的實際路徑更改
            dest_path = os.path.join(dest_folder, file_name)
            os.rename(file_path, dest_path)

            # 輸出偵錯訊息：移動檔案
            print(f'Moving file: "{file_name}"')

        else:
            # 檔案名稱不符合規則，輸出錯誤訊息
            print(f'!Error! Wrong file format or Wrong name format: "{file_name}"')
            
            # 移動照片到另一個資料夾
            dest_folder = '../wrongphoto'  # 根據您的實際路徑更改
            dest_path = os.path.join(dest_folder, file_name)
            os.rename(file_path, dest_path)

            # 輸出偵錯訊息：移動檔案
            print(f'Moving file: "{file_name}"')

    # 等待一段時間再檢查新檔案
    
    print(f'Waiting for new photos...\n')
    time.sleep(5)

# 關閉游標和連接（通常在程式結束時執行）
cursor.close()
connection.close()