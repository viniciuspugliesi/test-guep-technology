var Validator = (function() {
    function Validator() {}
    
    Validator.prototype.max = function(data, length) {
        return (data.length <= length);
    };
    
    Validator.prototype.min = function(data, length) {
        return (data.length >= length);
    };
    
    Validator.prototype.required = function(data) {
        if (!data) {
            return false;
        }
        
        data = String(data);
        
        return (data !== 'undefined' && data !== '');
    };
    
    return Validator;
})();