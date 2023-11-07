#!/bin/bash

# 定義程式路徑
SERVER_PY="raspiphoto/new/server.py"
LISTEN_MODEL_PY="raspiphoto/recognition/ListenAndModel.py"
ADD_SQL_PY="raspiphoto/toSQL/AddToSQL.py"

sudo iptables -I INPUT -p tcp --dport 1234 -j ACCEPT
echo "端口1234已開啟。"

# 啟動server.py
python3 "$SERVER_PY" &
SERVER_PID=$!

# 啟動ListenAndModel.py
python3 "$LISTEN_MODEL_PY" &
LISTEN_MODEL_PID=$!

# 啟動AddToSQL.py
python3 "$ADD_SQL_PY" &
ADD_SQL_PID=$!

# 顯示所有進程的PID
echo "啟動的進程PID："
echo "server.py: $SERVER_PID"
echo "ListenAndModel.py: $LISTEN_MODEL_PID"
echo "AddToSQL.py: $ADD_SQL_PID"

# 接收用戶輸入，如果輸入'end'則終止所有進程
echo "請輸入 'end' 來停止所有進程"
while :
do
  read INPUT_STRING
  if [ "$INPUT_STRING" = "end" ]; then
    kill $SERVER_PID
    kill $LISTEN_MODEL_PID
    kill $ADD_SQL_PID
    echo "所有進程已被停止。"

    # 關閉端口1234
    sudo iptables -D INPUT -p tcp --dport 1234 -j ACCEPT
    echo "端口1234已關閉。"
    break
  fi
done

echo "腳本結束。"
