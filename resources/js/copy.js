window.copy = function(sourceId) {
    let source = document.getElementById(sourceId)
    source.select()
    source.setSelectionRange(0, 99999) // For mobile devices

    document.execCommand("copy")

    let span = document.createElement('span')
    span.innerHTML = 'Copied'
    span.className = 'bg-gray-800 text-white text-xs rounded px-2 py-1 absolute'
    span.style.right = '2px'
    source.parentNode.insertBefore(span, this.parentNode)

    setTimeout(function() {
        span.remove()
    },1000)
}
