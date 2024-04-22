function toggleTextStyle(type: 'bold' | 'italic'): void {
    const selection: Selection | null = window.getSelection();
    if (!selection || selection.rangeCount === 0) return;

    const range: Range = selection.getRangeAt(0);
    const containerNode: Node = range.commonAncestorContainer;
    const tagType: string = type === 'bold' ? 'B' : 'I';

    let styledNode: HTMLElement | null = null;
    if (containerNode.nodeType === Node.ELEMENT_NODE && (containerNode as HTMLElement).tagName === tagType) {
        styledNode = containerNode as HTMLElement;
    } else if (containerNode.parentNode && (containerNode.parentNode as HTMLElement).tagName === tagType) {
        styledNode = containerNode.parentNode as HTMLElement;
    }

    if (styledNode) {
        const parent = styledNode.parentNode;
        if (!parent) return;

        const startOffset = Array.from(parent.childNodes).indexOf(styledNode);
        const newRange = document.createRange();

        while (styledNode.firstChild) {
            parent.insertBefore(styledNode.firstChild, styledNode);
        }
        parent.removeChild(styledNode);

        newRange.setStart(parent, startOffset);
        newRange.setEnd(parent, startOffset + 1);
        selection.removeAllRanges();
        selection.addRange(newRange);

    } else {
        const newNode: HTMLElement = document.createElement(tagType.toLowerCase());
        newNode.appendChild(range.extractContents());
        range.insertNode(newNode);

        selection.removeAllRanges();
        const newRange: Range = document.createRange();
        newRange.selectNodeContents(newNode);
        selection.addRange(newRange);
    }
}


const toggleBold = () => toggleTextStyle('bold');
const toggleItalic = () => toggleTextStyle('italic');

export { toggleBold, toggleItalic }
