
function showDebugInfo(msg, replace)
{
    if ($('#debug_info_box').length == 1) {
        var ogn_msg = replace === true ? '' : $('#debug_info_box').html();
        $('#debug_info_box').html(ogn_msg + msg + '<br>');
    }
}