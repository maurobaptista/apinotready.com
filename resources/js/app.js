window.copy = function(sourceId) {
    let source = document.getElementById(sourceId)
    source.select()
    source.setSelectionRange(0, 99999) // For mobile devices

    document.execCommand("copy")

    // This can be any valid HTML element: p, article, span, etc...
    let span = document.createElement('span')
    span.innerHTML = 'Copied'
    span.className = 'bg-gray-800 text-white text-xs rounded px-2 py-1 absolute'
    span.style.top = '-29px'
    span.style.left = '-6px'
    source.parentNode.insertBefore(span, this.previousSibling)

    setTimeout(function() {
        span.remove()
    },1000)

    console.log("Copied the text: " +  source.value)
}

