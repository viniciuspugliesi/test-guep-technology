var start = {
    
    functions: {
        addEventDestroy: function(){
            return Array.prototype.slice.call(document.getElementsByClassName('destroy'), 0);
        },
        
        confirmDestroy: function(button){
            var name = button.getAttribute('data-destroy');
            var href = button.getAttribute('data-href');
            
            document.getElementById("form-confirm-modal").setAttribute('action', href);
            document.getElementById("name-modal-confirm").innerHTML = name;
        },
        
        hideMessageError: function(){
            var messages = Array.prototype.slice.call(document.querySelectorAll('[data-message]'), 0);
            
            messages.forEach(function(message){
                message.classList.add('hide');
            });
        },
        
        showMessageError: function(name, message){
            document.querySelector('[data-message="'+name+'"]').innerHTML = message;
            document.querySelector('[data-message="'+name+'"]').classList.remove('hide');
            
            return false;
        }
    },
    
    events: {
        init: function(){
            start.functions.addEventDestroy().forEach(function(button){
                button.addEventListener('click', function(){
                    start.functions.confirmDestroy(button);
                });
            });
        }
    },
    
    form: {
        groups: function(){
            var validator = new Validator();
            
            document.forms['groups'].onsubmit = function(){
                start.functions.hideMessageError();
                
                var name = document.querySelector('input[name="name"]').value;
                
                if (!validator.required(name)) {
                    return start.functions.showMessageError('name', 'O nome do grupo é obrigatório.');
                }
                
                if (!validator.min(name, 3)) {
                    return start.functions.showMessageError('name', 'O nome do grupo deve conter mais de 3 caracteres.');
                }
                
                if (!validator.max(name, 50)) {
                    return start.functions.showMessageError('name', 'O nome do grupo deve conter menos de 50 caracteres.');
                }
            };
        },
        
        users: function(){
            var validator = new Validator();
            
            document.forms['users'].onsubmit = function(){
                start.functions.hideMessageError();
                
                // First name validation
                var first_name = document.querySelector('input[name="first_name"]').value;
                
                if (!validator.required(first_name)) {
                    return start.functions.showMessageError('first_name', 'O nome é obrigatório.');
                }
                
                if (!validator.min(first_name, 3)) {
                    return start.functions.showMessageError('first_name', 'O nome deve conter mais de 3 caracteres.');
                }
                
                if (!validator.max(first_name, 50)) {
                    return start.functions.showMessageError('first_name', 'O nome deve conter menos de 50 caracteres.');
                }
                
                
                // Last name validation
                var last_name = document.querySelector('input[name="last_name"]').value;
                
                if (!validator.required(last_name)) {
                    return start.functions.showMessageError('last_name', 'O sobrenome é obrigatório.');
                }
                
                if (!validator.min(last_name, 3)) {
                    return start.functions.showMessageError('last_name', 'O sobrenome deve conter mais de 3 caracteres.');
                }
                
                if (!validator.max(last_name, 50)) {
                    return start.functions.showMessageError('last_name', 'O sobrenome deve conter menos de 50 caracteres.');
                }
                
                
                // Group validation
                var group_id = document.querySelector('select[name="group_id[]"]').getElementsByTagName('option');
                
                var count = 0;
                for (var i = 0; i < group_id.length; i++) {
                    if (group_id[i].selected === true) {
                        count++;
                    }
                }
                
                if (count < 2) {
                    return start.functions.showMessageError('group_id', 'O usuário deve ter no mínimo 2 grupos.');
                }
            };
        }
    },
    
    init: function(){
        start.events.init();
    }
};

start.init();