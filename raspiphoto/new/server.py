'''
圖片會被自動下載到server.py的資料夾
'''

import socket

def handle_client(client_socket):
    str_data = client_socket.recv(1024)
    #print("Received a string:", str(str_data))
    if b'end' in str_data:
        str_dat_tmp = str_data[:str_data.index(b'end')]
        string = str(str_dat_tmp)
        name = string[2:len(string)-1]
        image_chunk = str_data[str_data.index(b'end')+3:]
    else:
        string = str(str_data)
        name = string[2:len(string)-1]
        str_data = client_socket.recv(2048)
        if b'end' in str_data:
            image_chunk = str_data[str_data.index(b'end')+3:]

    
    file = open(name, "wb")
    file.write(image_chunk)
    #print("image_chunk")
    #print(image_chunk)
    image_chunk = client_socket.recv(2048)

    while image_chunk:
        file.write(image_chunk)
        image_chunk = client_socket.recv(2048)
    client_socket.close()
    file.close()

    print("Server.py: Received an image.")

def main():
    server_socket = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
    server_socket.bind(("100.116.213.82", 1234))
    server_socket.listen()

    print("Server.py: Server is listening on port 1234")

    while True:
        client_socket, client_addr = server_socket.accept()
        print("Server.py: Accepted connection from:", client_addr)
        handle_client(client_socket)

if __name__ == "__main__":
    print("=======================")
    print("*** Start server.py ***")
    print("=======================")
    
    main()

