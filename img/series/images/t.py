import os


def rename_images_in_folder(folder_path):
    # Получаем список всех файлов в папке
    files = os.listdir(folder_path)

    # Отбираем только файлы с расширением .jpg
    jpg_files = [f for f in files if f.endswith('.jpg')]

    for file_name in jpg_files:
        # Отделяем имя файла от расширения
        base_name, ext = os.path.splitext(file_name)

        # Проверяем, является ли имя файла числом
        if base_name.isdigit():
            # Преобразуем имя файла в число
            number = int(base_name)

            # Формируем новое имя файла с ведущими нулями
            new_file_name = f'{number:05d}{ext}'

            # Получаем полный путь к старому и новому файлу
            old_file_path = os.path.join(folder_path, file_name)
            new_file_path = os.path.join(folder_path, new_file_name)

            # Переименовываем файл
            os.rename(old_file_path, new_file_path)
            print(f'Renamed {file_name} to {new_file_name}')


# Укажите путь к папке с изображениями
folder_path = './'
rename_images_in_folder(folder_path)
