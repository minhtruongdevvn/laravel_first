export default function debounce<T extends (...args: any[]) => any>(
    func: T,
    waitInSeconds: number,
    oneSecondCallback?: (sec: number) => void
): (...args: Parameters<T>) => void {
    let timeout: ReturnType<typeof setTimeout> | null = null;
    let countdownController: ReturnType<typeof setInterval> | null = null;
    const oneSecond = 1000;
    const wait = waitInSeconds * 1000;

    return function executedFunction(...args: Parameters<T>) {
        if (timeout !== null) {
            clearTimeout(timeout);
            timeout = null;
        }
        if (countdownController !== null) {
            clearInterval(countdownController);
            countdownController = null;
        }

        let countdown = waitInSeconds;
        oneSecondCallback?.(countdown);

        timeout = setTimeout(() => {
            func(...args);
            if (countdownController !== null) {
                clearInterval(countdownController);
                countdownController = null;
                oneSecondCallback?.(0);
            }
            timeout = null;
        }, wait);

        countdownController = setInterval(() => {
            countdown -= 1;
            if (countdown <= 0) {
                if (countdownController !== null) {
                    clearInterval(countdownController);
                    countdownController = null;
                }

            }

            oneSecondCallback?.(countdown);
        }, oneSecond);
    };
}
