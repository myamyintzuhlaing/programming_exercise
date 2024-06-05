students = input("Enter the names and scores: ")
threshold = input("Enter the trreshold: ")
list = []
for item in students.split(','):
    name, score = item.split(':')
    list.append((name.strip(), int(score.strip())))

#Finding Highest scroe
def find_max_score(list):
    max_score = None
    
    for sub_array in list:
        for element in sub_array:
            if isinstance(element, int):
                if max_score is None or element > max_score:
                    max_score = element
    return max_score

max_value = find_max_score(list)

def find_name(list, max_value):
    int_value = None
    corresponding_string = None
    for sub_array in list:
        if max_value in sub_array:
            int_value = max_value
            str_elements = [element for element in sub_array if isinstance(element, str)]
            corresponding_string = str_elements[0] if str_elements else None
    return int_value, corresponding_string

highest_score, corresponding_name = find_name(list, max_value)
print(f"Highest score: {corresponding_name} with {highest_score}")

#Above_threshold_students

def find_strings_for_integers_above_threshold(list, threshold):
    corresponding_strings = []

    for sub_array in list:
        int_elements = [element for element in sub_array if isinstance(element, int) and element > int(threshold)]
        
        # If any integers are greater than the threshold, collect corresponding strings
        if int_elements:
            str_elements = [element for element in sub_array if isinstance(element, str)]
            corresponding_strings.extend(str_elements)
    
    return corresponding_strings

students_above_threshold = find_strings_for_integers_above_threshold(list, threshold)
print(f"Students corresponding to scores greater than {threshold}: {students_above_threshold}")


#sorted list of students in decending order

def sort_integers_descending(list):

    list.sort(key=lambda x: x[1], reverse=True)
    
    return list

sorted_students = sort_integers_descending(list)
for name, score in sorted_students:
        print(f"{name}: {score}")